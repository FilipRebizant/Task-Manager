const Auth = {
    isAuthenticated: false,
    // TODO: Check for token every minute
    authenticate(callback) {
        //Ajax
        this.isAuthenticated = true;
    },

    signOut(callback) {
        this.isAuthenticated = false;
    }
};

export default Auth;