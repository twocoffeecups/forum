import auth from "./auth";
import isAdmin from "./isAdmin";
import userIsBanned from "./userIsBanned";
import guest from "./guest";
import canReadAdminDashboard from "./canReadAdminDashboard";

const Middleware = {
    auth, isAdmin, userIsBanned, guest, canReadAdminDashboard,
}

export default Middleware;

