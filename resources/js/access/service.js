import store from "../store";

const userPermissions = store.getters['auth/permissions'] ?? null;

function checkHasPermissions(permissions) {
    if(userPermissions === null) return false;
    return userPermissions.some(permission => permissions.includes(permission))
}
export {checkHasPermissions}



