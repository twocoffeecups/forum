import auth from "./auth";
import isAdmin from "./auth";
import userIsBanned from "./auth";

const Middleware = {
    auth, isAdmin, userIsBanned,
}

export default Middleware;

