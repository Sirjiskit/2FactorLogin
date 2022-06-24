/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Libray

"use strict";
$.fn.extend({
// With every keystroke capitalize first letter of ALLwords in the text
    upperFirstAll: function () {
        $(this).keyup(function (event) {
            var box = event.target;
            var txt = $(this).val();
            var start = box.selectionStart;
            var end = box.selectionEnd;
            $(this).val(txt.toLowerCase().replace(/^(.)|(\s|\-)(.)/g,
                    function (c) {
                        return c.toUpperCase();
                    }));
            box.setSelectionRange(start, end);
        });
        return this;
    },
    // Converts with every keystroke the hole text tolowercase
    lowerCase: function () {
        $(this).keyup(function (event) {
            var box = event.target;
            var txt = $(this).val();
            var start = box.selectionStart;
            var end = box.selectionEnd;
            $(this).val(txt.toLowerCase());
            box.setSelectionRange(start, end);
        });
        return this;
    },
    numberKey: function () {
        $(this).keypress(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
        return this;
    }
});

//isNumeric
function isPhone(val) {
    var filter = /^(080|090|070|081|091)+[0-9]{8}$/;
    if (filter.test(val)) {
        return true;
    } else {
        return false;
    }
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
$(document).ready(function () {
    $('[name="name"]').upperFirstAll();
    $('[name="email"]').lowerCase();
    $('[name="phone"]').numberKey();
    $('#btn-signup').click(async function (e) {
        e.preventDefault();
        $('#inputErr').hide();
        var $this = $(this);
        const check = await isValid();
        if (!check) {
            $('#inputErr').html('<i class="fa fa-times"></i> Input Error: Please fill all fields');
            $('#inputErr').show('slow');
            return false;
        }
        if (!isEmail($('[name="email"]').val())) {
            $('#inputErr').html('<i class="fa fa-times"></i> Input Error: Please enter a valid email address');
            $('#inputErr').show('slow');
            return false;
        }
        if (!isPhone($('[name="phone"]').val())) {
            $('#inputErr').html('<i class="fa fa-times"></i> Input Error: Please enter a valid phone number');
            $('#inputErr').show('slow');
            return false;
        }
        $(this).html('<i class="fa fa-spin fa-spinner"></i> Please wait....');
        $(this).attr("disabled", "true");
        var fd = new FormData();
        fd.append('name', $('[name="name"]').val());
        fd.append('email', $('[name="email"]').val());
        fd.append('phone', $('[name="phone"]').val());
        var api = new Api();
        api.fd = fd;
        api.url = `${window.siteurl}user/register`;
        api.http().then(raw => {
            var res = jQuery.parseJSON(raw);
            if (typeof res === 'object') {
                if (parseInt(res.status) === 200) {
                    $('#signUpPanel').hide('slow');
                    $('#signUpOtp').show('slow');
                    setUpOtp();
                    $(`#otp1`).focus();
                } else {
                    $this.removeAttr('disabled').html('Login');
                    $('#inputErr').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                }
            } else {
                $this.removeAttr('disabled').html('Login');
                $('#inputErr').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            }
        }).catch(() => {
            $this.removeAttr('disabled').html('Login');
            $('#inputErr').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
        });
    });
});

var isValid = function () {
    return new Promise((r) => {
        var name = $('[name="name"]').val();
        var email = $('[name="email"]').val();
        var phone = $('[name="phone"]').val();
        if (!name || name === '' || !email || email === '' || !phone || phone === '') {
            r(false);
        } else {
            r(true);
        }
    });

};
function setUpOtp() {
    for (var i = 1; i <= 6; i++) {
        $(`#otp${i}`).keyup(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            var index = parseInt($(this).attr('data-next'));

            if (charCode === 8) {
                var p = index - 2;
                var c = index - 1;
                if (c > 1) {
                    $(`#otp${p}`).removeAttr('disabled');
                    $(`#otp${p}`).focus();
                    $(`#otp${c}`).attr('disabled', true);

                } else {
                    $(`#opt1`).focus();
                }

            } else {
                if (index < 7) {
                    $(`#otp${index}`).removeAttr('disabled');
                    $(`#otp${index}`).focus();
                } else {
                    disabledAll();
                    $('#eCtr').hide();
                    $('#sLoader').html('<i class="fa fa-spin fa-spinner"></i> Please wait....');
                    verifyRegister();
                }
            }
        });
    }
}
function disabledAll() {
    for (var i = 1; i <= 6; i++) {
        $(`#otp${i}`).attr('disabled', true);
    }
}
function emptyAll() {
    for (var i = 1; i <= 6; i++) {
        $(`#otp${i}`).val('');
    }
    $(`#otp1`).removeAttr('disabled').focus();
}
function resent() {
    $('#inputErr2').show('slow').html(``);
    var fd = new FormData();
    fd.append('email', $('[name="email"]').val());
    disabledAll();
    $('#eCtr').hide();
    $('#sLoader').html('<i class="fa fa-spin fa-spinner"></i> Please wait....');
    var api = new Api();
    api.fd = fd;
    api.url = `${window.siteurl}user/resent`;
    api.http().then(raw => {
        var res = jQuery.parseJSON(raw);
        if (typeof res === 'object') {
            if (parseInt(res.status) === 200) {
                $('#eCtr').show();
                $('#sLoader').html('');
                emptyAll();
            } else {
                $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                $('#eCtr').show();
                $('#sLoader').html('');
                emptyAll();
            }
        } else {
            $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            $('#eCtr').show();
            $('#sLoader').html('');
            emptyAll();
        }
    }).catch(() => {
        $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
        $('#eCtr').show();
        $('#sLoader').html('');
        emptyAll();
    });
}
function verifyRegister() {
    $('#inputErr2').show('slow').html(``);
    var email = $('[name="email"]').val();
    var otp = `${$(`#otp1`).val()}${$(`#otp2`).val()}${$(`#otp3`).val()}${$(`#otp4`).val()}${$(`#otp5`).val()}${$(`#otp6`).val()}`;
    var fd = new FormData();
    fd.append('email', email);
    fd.append('otp', otp);
    var api = new Api();
    api.fd = fd;
    api.url = `${window.siteurl}user/verify_register`;
    api.http().then(raw => {
        var res = jQuery.parseJSON(raw);
        if (typeof res === 'object') {
            if (parseInt(res.status) === 200) {
                $('#signUpOtp').hide('slow');
                $('#verified').show('slow');
            } else {
                $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                $('#eCtr').show();
                $('#sLoader').html('');
                emptyAll();
            }
        } else {
            $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            $('#eCtr').show();
            $('#sLoader').html('');
            emptyAll();
        }
    }).catch(() => {
        $('#inputErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
        $('#eCtr').show();
        $('#sLoader').html('');
        emptyAll();
    });
}
class Api {
    fd = new FormData();
    url = '';
    http() {
        var $this = this;
        return new Promise(resolve => {
            $.ajax({
                url: $this.url,
                data: $this.fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    resolve(data);
                }, error: function (err) {
                    resolve({status: 201, msg: `Error: ${err.message}`});
                }
            });
        });
    }
}




//Handle Login

$(document).ready(function () {
    $('#btn-login').click(async function (e) {
        e.preventDefault();
        $('#loginErr').hide();
        var $this = $(this);
        const check = await isValid2();
        if (!check) {
            $('#loginErr').html('<i class="fa fa-times"></i> Input Error: Please fill all fields');
            $('#loginErr').show('slow');
            return false;
        }
        $('#loginErr').show('slow').html(``);
        var fd = new FormData();
        fd.append('email', $('[name="username"]').val());
        fd.append('password', $('[name="password"]').val());
        disabledAll();
        $this.html('<i class="fa fa-spin fa-spinner"></i> Please wait....');

        var api = new Api();
        api.fd = fd;
        api.url = `${window.siteurl}user/login`;
        api.http().then(raw => {
            var res = jQuery.parseJSON(raw);
            if (typeof res === 'object') {
                if (parseInt(res.status) === 200) {
                    $this.html('Login pass');
                    $('#signInPanel').hide('slow');
                    $('#signInOtp').show('slow');
                    setUpMyLogOtp();
                    $(`#lOpt1`).focus();
                } else {
                    $('#loginErr').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                    $this.html('Login');
                }
            } else {
                $('#loginErr').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
                $this.html('Login');
            }
        }).catch(() => {
            $('#loginErr').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            $this.html('Login');
        });
    });
});
var isValid2 = function () {
    return new Promise((r) => {
        var email = $('[name="username"]').val();
        var pass = $('[name="password"]').val();
        if (!pass || pass === '' || !email || email === '') {
            r(false);
        } else {
            r(true);
        }
    });

};

function setUpMyLogOtp() {
    for (var i = 1; i <= 6; i++) {
        $(`#lOpt${i}`).keyup(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            var index = parseInt($(this).attr('data-next'));
            if (charCode === 8) {
                var p = index - 2;
                var c = index - 1;
                if (c > 1) {
                    $(`#lOpt${p}`).removeAttr('disabled');
                    $(`#lOpt${p}`).focus();
                    $(`#lOpt${c}`).attr('disabled', true);

                } else {
                    $(`#lOpt1`).focus();
                }

            } else {
                if (index < 7) {
                    $(`#lOpt${index}`).removeAttr('disabled');
                    $(`#lOpt${index}`).focus();
                } else {
                    disabledAllLog();
                    $('#lCtr').hide();
                    $('#lLoader').html('<i class="fa fa-spin fa-spinner"></i> Please wait....');
                    verifyLogin();
                }
            }
        });
    }
}
function disabledAllLog() {
    for (var i = 1; i <= 6; i++) {
        $(`#lOpt${i}`).attr('disabled', true);
    }
}
function emptyAllLog() {
    for (var i = 1; i <= 6; i++) {
        $(`#lOpt${i}`).val('');
    }
    $(`#lOpt1`).removeAttr('disabled').focus();
}
function verifyLogin() {
    $('#loginErr2').show('slow').html(``);
    var email = $('[name="username"]').val();
    var otp = `${$(`#lOpt1`).val()}${$(`#lOpt2`).val()}${$(`#lOpt3`).val()}${$(`#lOpt4`).val()}${$(`#lOpt5`).val()}${$(`#lOpt6`).val()}`;
    var fd = new FormData();
    fd.append('email', email);
    fd.append('otp', otp);
    var api = new Api();
    api.fd = fd;
    api.url = `${window.siteurl}user/verify_login`;
    api.http().then(raw => {
        var res = jQuery.parseJSON(raw);
        if (typeof res === 'object') {
            if (parseInt(res.status) === 200) {
                window.location = window.siteurl;
            } else {
                $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                $('#lCtr').show();
                $('#lLoader').html('');
                emptyAllLog();
            }
        } else {
            $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            $('#lCtr').show();
            $('#lLoader').html('');
            emptyAllLog();
        }
    }).catch(() => {
        $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
        $('#lCtr').show();
        $('#lLoader').html('');
        emptyAllLog();
    });
}
function resent2() {
    $('#loginErr2').show('slow').html(``);
    var fd = new FormData();
    fd.append('email', $('[name="username"]').val());
    disabledAll();
    $('#lCtr').hide();
    $('#lLoader').html('<i class="fa fa-spin fa-spinner"></i> Please wait....');
    var api = new Api();
    api.fd = fd;
    api.url = `${window.siteurl}user/resent`;
    api.http().then(raw => {
        var res = jQuery.parseJSON(raw);
        if (typeof res === 'object') {
            if (parseInt(res.status) === 200) {
                $('#lCtr').show();
                $('#lLoader').html('');
                emptyAllLog();
            } else {
                $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (${res.status}): ${res.msg}`);
                $('#lCtr').show();
                $('#lLoader').html('');
                emptyAllLog();
            }
        } else {
            $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
            $('#lCtr').show();
            $('#lLoader').html('');
            emptyAllLog();
        }
    }).catch(() => {
        $('#loginErr2').show('slow').html(`<i class="fa fa-times"></i> Error (501)}): Unknown error occurred please try aain later!`);
        $('#lCtr').show();
        $('#lLoader').html('');
        emptyAllLog();
    });
}