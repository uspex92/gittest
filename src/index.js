(function () {
    var currentAccount = null;
    if (window.ethereum && window.ethereum.isMetaMask) {
        var provider = detectEthereumProvider();
        if (provider) {
            console.log('Ethereum successfully detected!')
            // For now, 'eth_accounts' will continue to always return an array
            function handleAccountsChanged(accounts) {
                if (accounts.length === 0) {
                    // MetaMask is locked or the user has not connected any accounts
                    $('.error').html('Please connect to MetaMask.').removeClass('hide');
                } else if (accounts[0] !== currentAccount) {
                    $('.error').html('').addClass('hide');
                    currentAccount = accounts[0];
                    $('#walletId').val(currentAccount);
                    // Do any other work!
                    $('#connectButton').hide();
                    $('#transactionButton').show();
                }
            }
            ethereum.request({ method: 'eth_accounts' }).then(handleAccountsChanged);
            ethereum.on('accountsChanged', handleAccountsChanged);
        }
        function connect() {
            if (!currentAccount) {
                ethereum
                    .request({ method: 'eth_requestAccounts' })
                    .then(handleAccountsChanged)
                    .catch((err) => {
                        if (err.code === 4001) {
                            $('.error').html('Please connect to MetaMask.').removeClass('hide');
                        } else {
                            $('.error').html('').addClass('hide');
                            $('#walletId').val(currentAccount);
                        }
                    });
            }
        }
        function transaction() {
            var transactionParameters = {
                gasPrice: window.walletConfig.gasPrice, // customizable by user during MetaMask confirmation.
                gas: window.walletConfig.gas, // customizable by user during MetaMask confirmation.
                to: window.walletConfig.id, // Required except during contract publications.
                from: currentAccount, // must match user's active address.
                value: window.walletConfig.amount, // Only required to send ether to the recipient from the initiating external account.
            };
            var txHashResult;
            ethereum.request({
                method: 'eth_sendTransaction',
                params: [transactionParameters],
            }).then((txHash) => {
                txHashResult = txHash;
                $('#transaction').val(txHashResult);
                $('#save').trigger('submit');
            });
        }
        $('#connectButton').on('click', connect);
        $('#transactionButton').on('click', transaction);
    } else {
        $('.error').html('Please install MetaMask!').removeClass('hide');
    }

    $('#checkButton').click(function () {
        var url = $('#save').data('check-user');
        $.ajax({
            type: "POST", // Method type GET/POST
            url: url, //Ajax Action url
            data: {
                walletID: $('#walletId').val()
            },
            success: function (data) {
                $('.js-users').html(data);
            }
        });
    });

    // Hide Header on on scroll down
    var did_scroll;
    var last_scroll_top = 0;
    var damper = 20; // the number of pixels scrolled before header state is changed.
    var header = $('header').outerHeight();

    $(window).scroll(function (event) {
        did_scroll = true;
    });

    setInterval(function () {
        if (did_scroll) {
            has_scrolled();
            did_scroll = false;
        }
    }, 250);

    function has_scrolled() {
        var st = $(this).scrollTop();
        // fail first, return false if the user fails to scroll more than the specified damper.
        if (Math.abs(last_scroll_top - st) <= damper) {
            return;
        }
        if (st > last_scroll_top && st > header) {
            // Scroll Down
            $('header').addClass('hide-nav');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('header').removeClass('hide-nav');
            }
        }
        last_scroll_top = st;
    }
}());