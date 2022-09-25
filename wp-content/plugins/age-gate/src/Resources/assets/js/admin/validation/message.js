import { MESSAGE, MESSAGE_MD, ALPHA_NUMERIC_SPACE } from './expressions';

export const message = (validation, form) => {

    const messageFields = [
        'headline',
        'subheadline',
        'label_aria',
        'label_buttons',
        'label_no_cookies',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    Array.from(document.querySelectorAll(messageFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'customRegexp',
                value: MESSAGE
            }
        ]);
    });

    const alphaNumericSpaceFields = [
        'label_remember',
        'label_yes',
        'label_no',
        'label_day',
        'label_month',
        'label_year',
        'placeholder_day',
        'placeholder_month',
        'placeholder_year',
        'label_submit',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    Array.from(document.querySelectorAll(alphaNumericSpaceFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'customRegexp',
                value: ALPHA_NUMERIC_SPACE
            }
        ]);
    });

    const messageMDFields = [
        'error_invalid',
        'error_failed',
        'error_generic',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    Array.from(document.querySelectorAll(messageMDFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'customRegexp',
                value: MESSAGE_MD
            }
        ]);
    });
}
