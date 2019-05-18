export function orderStatusFilter(status) {
    let statusName 
    switch (status) {
        case 0:
            statusName = '待付款';
            break;
        case 1:
            statusName = '拼团中';
            break;
        case 2:
            statusName = '拼团成功，待发货';
            break;
        case 3:
            statusName = '拼团失败';
            break;
        case 4:
            statusName = '已发货';
            break;
        case 5:
            statusName = '已签收';
            break;
        default:
            statusName = '订单状态异常'
    }

    return statusName
}