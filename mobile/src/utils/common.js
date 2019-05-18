export function reload() {
    window.location.reload()
}
/**
 * 反转对象的key与value
 */
export const invertKeyValues = obj =>
  Object.keys(obj).reduce((acc, key) => {
    acc[obj[key]] = key;
    return acc;
  }, {});
