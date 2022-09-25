import Cookies from "js-cookie";
import { on } from '../admin/utility/on';

window.addEventListener('DOMContentLoaded', () => {

    on('#wp-admin-bar-age-gate-toggle', 'click', '.ab-item', (e) => {
        e.preventDefault();

        const { ag_cookie_domain, ag_cookie_name } = window;

        console.log(ag_cookie_domain, ag_cookie_name);
        if (Cookies.get(ag_cookie_name)) {
            const data = new FormData;
            data.append('action', 'ag_clear_cookie');

            Cookies.set(ag_cookie_name, 1, {
                secure: true,
                path: '/',
                domain: ag_cookie_domain,
                expires: -1,
                sameSite: 'None',
            });
        } else {
            Cookies.set(ag_cookie_name, '99', {
                secure: true,
                path: '/',
                domain: ag_cookie_domain,
                sameSite: 'None',

            });
        }

        window.location.reload();
    });
});
