export const content = (validation, form) => {
    Array.from(form.querySelectorAll('input[type="number"]')).forEach((input) => {
        validation.addField(`[name="${input.name}"]`, [
            {
                rule: 'number',
            }
        ]);
    });
}
