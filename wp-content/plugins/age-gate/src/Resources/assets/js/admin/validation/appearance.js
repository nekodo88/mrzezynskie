import { MESSAGE, HEX, APLHA } from './expressions';

export const appearance = (validation, form) => {

    const hexFields = [
        'background_color',
        'foreground_color',
        'text_color',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    const numberFields = [
        'logo',
        'blur',
        'background_image',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    const floatFields = [
        'background_opacity',
        'background_image_opacity',
        'foreground_opacity',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    const alphaFields = [
        'y',
        'x',
        'exit_transition',
    ].map(item => `[name*="[${item}]"]`).join(', ');

    const messageFields = [
        'custom_title',
    ].map(item => `[name*="[${item}]"]`).join(', ');



    Array.from(document.querySelectorAll(hexFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'customRegexp',
                value: HEX
            }
        ]);
    });

    Array.from(document.querySelectorAll(messageFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'customRegexp',
                value: MESSAGE
            }
        ]);
    });

    Array.from(document.querySelectorAll(numberFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'number',
            }
        ]);
    });


    validation.addField('[name="ag_settings[background_position][x]"]', [
        {
            rule: 'customRegexp',
            value: /(left|right|center)/
        }
    ]);

    validation.addField('[name="ag_settings[background_position][y]"]', [
        {
            rule: 'customRegexp',
            value: /(top|bottom|center)/
        }
    ]);

    validation.addField('[name="ag_settings[exit_transition]"]', [
        {
            rule: 'customRegexp',
            value: /(fade|slide-up|slide-down|slide-left|slide-right)/
        }
    ]);


    Array.from(document.querySelectorAll(floatFields)).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                validator: val => {
                    const value = parseFloat(val);

                    if (value === 1 || value === 0) {
                        return true;
                    }

                    return !Number.isInteger(value) && Number.isFinite(value);
                }
            }
        ]);
    });



}
