import store from "../store";

function checkHasPermissions(permissions) {
    const userPermissions = store.getters['middleware/permissions'] ?? null;
    if(userPermissions === null) return false;
    return userPermissions.some(permission => permissions.includes(permission));
}
export {checkHasPermissions}



