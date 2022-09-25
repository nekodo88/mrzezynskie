export const restriction = (validation, form) => {
    Array.from(form.querySelectorAll('input[type="number"]')).forEach(el => {
        validation.addField(`[name="${el.name}"]`, [
            {
                // rule: 'customRegexp',
                // value: /(all|selected)/,
                rule: 'number',
                // errorMessage: 'Number'
            }
        ])
    });

    validation.addField('[name="ag_settings[type]"]', [
        {
            rule: 'customRegexp',
            value: /(all|selected)/,
        }
    ]);

    validation.addField('[name="ag_settings[input_type]"]', [
        {
            rule: 'customRegexp',
            value: /(inputs|buttons|selects)/,
        }
    ]);

    validation.addField('[name="ag_settings[date_format]"]', [
        {
            rule: 'customRegexp',
            value: /(DD MM YYYY|MM DD YYYY|YYYY MM DD)/,
        }
    ]);

    validation.addField('[name="ag_settings[button_order]"]', [
        {
            rule: 'customRegexp',
            value: /(no-yes|yes-no)/,
        }
    ]);

    validation.addField('[name="ag_settings[remember_length][remember_time]"]', [
        {
            rule: 'customRegexp',
            value: /(days|hours|minutes)/,
        }
    ]);

    Array.from(document.querySelectorAll('.ag-field--link input')).forEach((link) => {
        validation.addField(`[name="${link.name}"]`, [
            {
                rule: 'customRegexp',
                value: /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/,
                errorMessage: 'Full URL required',
            }
        ])
    });
};
