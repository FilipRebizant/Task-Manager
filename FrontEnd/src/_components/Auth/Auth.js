const Auth = {
    isAuthenticated: localStorage.getItem('token') ? true : false,

    // TODO: Check for token every minute
    authenticate(callback) {
        //Ajax
        this.isAuthenticated = true;
    },

    signOut(callback) {
        this.isAuthenticated = false;
        localStorage.removeItem('token');
    }
};

export default Auth;