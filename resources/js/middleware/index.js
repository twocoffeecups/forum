import auth from "./auth";
import isAdmin from "./isAdmin";
import userIsBanned from "./userIsBanned";
import guest from "./guest";

const Middleware = {
    auth, isAdmin, userIsBanned, guest,
}

export default Middleware;

