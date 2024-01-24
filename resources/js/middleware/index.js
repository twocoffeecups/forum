import auth from "./auth";
import userIsBanned from "./userIsBanned";
import guest from "./guest";

const Middleware = {
    auth, userIsBanned, guest,
}

export default Middleware;

