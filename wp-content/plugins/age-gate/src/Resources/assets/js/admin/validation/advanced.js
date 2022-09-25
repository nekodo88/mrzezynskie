export const advanced = (validation, form) => {
    validation.addField('[name="ag_settings[cookie_name]"]', [
        {
            rule: 'customRegexp',
            value: /([a-z_])+$/i
        }
    ]);

    validation.addField('[name="ag_settings[method]"]', [
        {
            rule: 'customRegexp',
            value: /(js|standard)+$/i
        }
    ]);

    validation.addField('[name="ag_settings[css_type]"]', [
        {
            rule: 'customRegexp',
            value: /(v2|v3)+$/i
        }
    ]);

}
