//import Inputmask from "inputmask";
// Inputmask({regex: String.raw`^\+375 (17|25|29|33|44) [0-9]{3} [0-9]{2} [0-9]{2}$`}).mask(reg_phone);

export const Validator = {
    ERROR_REQUIRE_FIELD: 'Required field',
    ERROR_EMPTY_PROMOCODE_FIELD: 'Enter promotional code',
    ERROR_EMAIL_FIELD: 'Please enter a valid email',
    ERROR_AGREE_FIELD: 'Consent to data processing required',
    ERROR_PHONE_FORMAT_FIELD: 'Не верный формат телефона: +375YYXXXXXXX',
    email: function (email) {
        let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    },
    phone: function (phone) {
        let re = /^\+375 (17|25|29|33|44) [0-9]{3} [0-9]{2} [0-9]{2}$/;
        return re.test(phone);
    },
    phoneType2: function (phone) {
        let re = /^\+375(17|25|29|33|44)[0-9]{7}$/;
        return re.test(phone);
    }
};