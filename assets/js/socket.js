const conn = new WebSocket('ws://localhost:8080');

conn.onopen = function (e) {
    console.log("Khởi tạo kết nối thành công!");
};
function sendMessage(loaitk, nguoigui, nguoinhan, noidung) {
    waitForSocketConnection(conn, function () {
        conn.send(JSON.stringify({
            LoaiTK: loaitk,
            NguoiGui: nguoigui,
            NguoiNhan: nguoinhan,
            NoiDung: noidung
        }));
    });
};
function waitForSocketConnection(socket, callback) {
    setTimeout(() => {
        if (socket.readyState === 1) {
            if (callback !== undefined) {
                callback();
            }
            return;
        } else {
            waitForSocketConnection(socket, callback);
        }
    }, 5);
};

conn.onmessage = async function (e) {
    const data = JSON.parse(e.data);
    const NguoiNhan = data?.NguoiNhan;
    const loaiTK = data?.LoaiTK;
    if (NguoiNhan === MANV && loaiTK === LOAITK) {
        const url = "http://localhost/QuanLyTienLuong_PHP/api/api-countnew-notification.php";
        const data = {
            NguoiNhan: NguoiNhan
        }
        const { message, status, newNotiNumber } = await postData(url, data);
        console.log(newNotiNumber);
        if (status && newNotiNumber > 0) {
            $('#num-noti').css({ 'background-color': 'red' })
            $('#num-noti').text(`${newNotiNumber}`);
        }
    }
}