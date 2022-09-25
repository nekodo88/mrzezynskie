import JustValidate from 'just-validate';
import * as VALIDATION_DATA from '../validation';

const {
    restriction,
    // message,
    appearance,
    advanced,
    content,
    tools,
} = VALIDATION_DATA;


global.ag_restriction = restriction;
// global.ag_message = message;
global.ag_appearance = appearance;
global.ag_advanced = advanced;
global.ag_content = content;
global.ag_tools = tools;

window.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ag-settings');

    if (!form) {
        return;
    }
    const method = `ag_${form.dataset.form}`;

    if (window[method]) {
        console.log('init');

        const validation = new JustValidate(form, {
            errorFieldCssClass: 'ag--invalid',
            errorsContainer: document.querySelector('.ag-errors'),
            errorLabelCssClass: 'notice notice-error',
        });


        window[method](validation, form);

        validation.onSuccess(() => HTMLFormElement.prototype.submit.call(form));

        validation.onFail(fields => console.log(fields));

    }

    Array.from(document.querySelectorAll('.ag-form__reset')).forEach((resetForm) => {
        const resetValidation = new JustValidate(resetForm, {
            errorFieldCssClass: 'ag--invalid',
            // testingMode: true,
        });

        resetValidation.addField('[name="pwd"]', [
            {
                rule: 'required',
            }
        ])
        .onSuccess(() => {
            if (confirm('Are you sure?') === true) {
                resetForm.submit();
            }
        })
    });
});
