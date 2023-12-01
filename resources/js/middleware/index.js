import auth from "./auth";
import isAdmin from "./auth";
import isUser from "./auth";
import userIsBanned from "./auth";
import guest from "./guest";

const Middleware = {
    auth, isAdmin, isUser, userIsBanned, guest,
}

export default Middleware;

