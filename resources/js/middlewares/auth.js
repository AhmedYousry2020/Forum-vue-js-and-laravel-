export default function auth({next,store}){
    console.log('auth middleware is run');
    if(!store.getters['auth/check']) return next({name : "login"})
    else return next();
    }
