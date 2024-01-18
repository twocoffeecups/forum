import store from "../store";

let userPermissions = store.getters['middleware/permissions'] ?? null;

function checkHasPermissions(permissions) {
    if(userPermissions === null) return false;
    return userPermissions.some(permission => permissions.includes(permission))
}
export {checkHasPermissions}



