export function authHeader() {
    let token = JSON.parse(localStorage.getItem('token'));

    return { 'Authorization': 'Bearer' + token};
}