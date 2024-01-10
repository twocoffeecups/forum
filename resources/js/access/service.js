import store from "../store";

let userPermissions = store.getters['middleware/permissions'] ?? null;

function checkHasPermissions(permissions) {
    if(userPermissions === null) return false;
    // console.log("PERMISSIONS AAA: ", permissions);
    // console.log("USER PERMISSIONS AAA: ", userPermissions);
    return userPermissions.some(permission => permissions.includes(permission))
}
export {checkHasPermissions}



