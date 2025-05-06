@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Đặt vé cho phim: {{ $movie->title }}</h2>
    <div class="row mb-3">
        <div class="col-md-3">
            <img src="{{ Str::startsWith($movie->poster, 'http') ? $movie->poster : asset('storage/posters/' . $movie->poster) }}" alt="{{ $movie->title }}" style="width:100%;height:220px;object-fit:cover;">
        </div>
        <div class="col-md-9">
            <p><b>Thời lượng:</b> {{ $movie->duration }} phút</p>
            <p><b>Mô tả:</b> {{ $movie->description }}</p>
        </div>
    </div>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="showtime_id" class="form-label">Chọn suất chiếu:</label>
            <select name="showtime_id" id="showtime_id" class="form-select" required>
                <option value="">-- Chọn suất chiếu --</option>
                @foreach($showtimes as $showtime)
                    <option value="{{ $showtime->id }}">
                        {{ $showtime->show_date }} | {{ $showtime->start_time }} - {{ $showtime->end_time }} | Phòng: {{ $showtime->room->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ghế:</label>
            <div id="room-name" class="mb-2"></div>
            <!-- Chỗ này sẽ được JS tạo input hidden seat_ids[] cho từng ghế đã chọn -->
<div id="seat-ids-wrapper"></div>
            <button type="button" class="btn btn-outline-primary mt-2" id="open-seat-modal">Chọn ghế</button>

            <div id="selected-seats" class="mt-2"></div>
            <!-- Modal chọn ghế -->
            <div class="modal fade" id="seatModal" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="seatModalLabel">Chọn ghế cho suất chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div style="width:100%;text-align:center;margin-bottom:8px;font-weight:bold;font-size:20px;letter-spacing:2px;">MÀN HÌNH</div>
                    <div id="seat-map" style="display: flex; flex-direction: column; gap: 7px; align-items: center;"></div>
                    <div class="seat-legend" style="margin-bottom: 12px; justify-content: center; display: flex; flex-wrap: wrap;">
                        <span class="seat-btn seat-thuong"></span> <span class="seat-legend-label">Ghế thường</span>
                        <span class="seat-btn seat-vip"></span> <span class="seat-legend-label">Ghế VIP</span>
                        <span class="seat-btn seat-sweetbox"></span> <span class="seat-legend-label">Sweetbox (ghế đôi)</span>
                        <span class="seat-btn seat-selected"></span> <span class="seat-legend-label">Đang chọn</span>
                        <span class="seat-btn seat-booked"></span> <span class="seat-legend-label">Đã đặt</span>
                    </div>
                    <div id="modal-selected-seats" class="mt-2"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="confirm-seat-selection">Xác nhận chọn ghế</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <style>
            .seat-btn { width: 42px; height: 42px; margin: 3px; border-radius: 8px; border: 2px solid #ccc; cursor: pointer; font-weight: bold; transition: 0.2s; position: relative; }
            .seat-thuong { background: #6c63ff; color: #fff; }
            .seat-vip { background: #ff3c3c; color: #fff; }
            .seat-sweetbox { background: #ff69b4 !important; color: #fff; }
/* Hiệu ứng ghế đôi sát cạnh */
.seat-double-left {
    border-radius: 16px 0 0 16px !important;
    margin-right: 0px;
    z-index: 2;
}
.seat-double-right {
    border-radius: 0 16px 16px 0 !important;
    margin-left: 0px;
    margin-right: 8px;
    z-index: 2;
}
/* Xóa margin giữa 2 ghế đôi */
.seat-double-left + .seat-double-right {
    margin-left: -4px;
}
            
            .seat-selected { border: 2.5px solid #00c3ff; box-shadow: 0 0 6px #00c3ff; }
            .seat-booked { background: #888; color: #eee; cursor: not-allowed; text-decoration: line-through; }
            .seat-btn[title]:hover:after {
                content: attr(title);
                position: absolute;
                left: 50%;
                top: -32px;
                transform: translateX(-50%);
                background: #222; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; white-space: nowrap;
                z-index: 10;
            }
            .seat-legend { display: flex; gap: 18px; margin-bottom: 8px; align-items: center; justify-content: center; flex-wrap: wrap; }
            .seat-legend span { display: inline-block; width: 28px; height: 28px; border-radius: 6px; margin-right: 5px; vertical-align: middle; }
            .seat-legend-label { font-size: 15px; }
        </style>

        <script>
        let seatData = [];
        let selectedSeatIds = [];
        let modalSelectedSeatIds = [];
        let seatModal = null;
        document.getElementById('showtime_id').addEventListener('change', function() {
            const showtimeId = this.value;
            if (!showtimeId) return;
            fetch(`/seats/show?showtime_id=${showtimeId}`)
                .then(res => res.json())
                .then(data => {
                    seatData = data.seats;
                    selectedSeatIds = [];
                    modalSelectedSeatIds = [];
                    document.getElementById('seat_ids').value = '';
                    document.getElementById('selected-seats').innerHTML = '';
                    document.getElementById('room-name').innerHTML = '<b>Phòng chiếu:</b> ' + data.room;
                    // Không render sơ đồ ghế ở ngoài form nữa
                });
        });
        // Modal bootstrap 5
        document.addEventListener('DOMContentLoaded', function() {
            seatModal = new bootstrap.Modal(document.getElementById('seatModal'));
            document.getElementById('open-seat-modal').onclick = function() {
                if (!seatData.length) return alert('Vui lòng chọn suất chiếu trước!');
                modalSelectedSeatIds = [...selectedSeatIds];
                renderSeatMapModal();
                seatModal.show();
            };
            document.getElementById('confirm-seat-selection').onclick = function() {
    selectedSeatIds = [...modalSelectedSeatIds];
    // Xóa input cũ
    const seatIdsWrapper = document.getElementById('seat-ids-wrapper');
    seatIdsWrapper.innerHTML = '';
    // Tạo input hidden cho từng ghế đã chọn
    selectedSeatIds.forEach(function(seatId) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'seat_ids[]';
        input.value = seatId;
        seatIdsWrapper.appendChild(input);
    });
    updateSelectedSeats();
    seatModal.hide();
};
        });
        function renderSeatMapModal() {
            const seatMapDiv = document.getElementById('seat-map');
            seatMapDiv.innerHTML = '';
            const rows = {};
            seatData.forEach(seat => {
                const row = seat.row || seat.seat_number.charAt(0);
                if (!rows[row]) rows[row] = [];
                rows[row].push(seat);
            });
            const sortedRows = Object.keys(rows).sort();
            let maxSeats = 0;
            sortedRows.forEach(row => {
                if (rows[row].length > maxSeats) maxSeats = rows[row].length;
            });
            sortedRows.forEach(row => {
                const rowDiv = document.createElement('div');
                rowDiv.style.display = 'flex';
                const seatCount = rows[row].length;
                if (seatCount < maxSeats) {
                    const pad = Math.floor((maxSeats - seatCount) / 2);
                    if (pad > 0) {
                        rowDiv.appendChild(document.createElement('span')).style.width = (pad * 48) + 'px';
                    }
                }
                rows[row].sort((a,b) => (a.col || parseInt(a.seat_number.slice(1))) - (b.col || parseInt(b.seat_number.slice(1))));
                let sweetboxIndex = 0;
for (let i = 0; i < rows[row].length; i++) {
    const seat = rows[row][i];
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.innerText = seat.seat_number;
    // Xác định vị trí ghế đôi trái/phải
    let doubleClass = '';
    if (seat.type === 'sweetbox') {
        if (sweetboxIndex % 2 === 0) doubleClass = ' seat-double-left';
        else doubleClass = ' seat-double-right';
        sweetboxIndex++;
    }
    btn.className = 'seat-btn seat-' + seat.type + doubleClass + (seat.booked ? ' seat-booked' : '') + (modalSelectedSeatIds.includes(seat.id) ? ' seat-selected' : '');
    btn.disabled = seat.booked;
    let seatPrice = seat.price !== null && seat.price !== undefined ? (isNaN(seat.price) ? 0 : parseInt(seat.price)) : 0;
    btn.setAttribute('title', `Ghế ${seat.seat_number} - ${seat.type === 'sweetbox' ? 'Sweetbox' : seat.type === 'vip' ? 'VIP' : 'Thường'} - ${seatPrice.toLocaleString()}đ`);
    btn.onclick = function() {
        if (btn.classList.contains('seat-booked')) return;
        // Nếu là ghế đôi (sweetbox, is_double)
        if (seat.type === 'sweetbox') {
    // Tìm ghế sweetbox liền kề (cặp chẵn-lẻ)
    const rowSeats = rows[seat.row || seat.seat_number.charAt(0)];
    const idx = rowSeats.findIndex(s => s.id === seat.id);
    let pairSeat = null;
    if (idx % 2 === 0 && idx < rowSeats.length - 1 && rowSeats[idx+1].type === 'sweetbox') {
        pairSeat = rowSeats[idx+1];
    } else if (idx % 2 === 1 && idx > 0 && rowSeats[idx-1].type === 'sweetbox') {
        pairSeat = rowSeats[idx-1];
    }
    if (modalSelectedSeatIds.includes(seat.id)) {
        // Bỏ chọn cả cặp
        modalSelectedSeatIds = modalSelectedSeatIds.filter(id => id !== seat.id && (!pairSeat || id !== pairSeat.id));
    } else {
        // Chọn cả cặp
        if (!modalSelectedSeatIds.includes(seat.id)) modalSelectedSeatIds.push(seat.id);
        if (pairSeat && !modalSelectedSeatIds.includes(pairSeat.id)) modalSelectedSeatIds.push(pairSeat.id);
    }
} else {
            if (modalSelectedSeatIds.includes(seat.id)) {
                modalSelectedSeatIds = modalSelectedSeatIds.filter(id => id !== seat.id);
            } else {
                modalSelectedSeatIds.push(seat.id);
            }
        }
        renderSeatMapModal();
        updateModalSelectedSeats();
    };
    rowDiv.appendChild(btn);
}
    seatMapDiv.appendChild(rowDiv);
});
            updateModalSelectedSeats();
        }
        function updateModalSelectedSeats() {
            const info = seatData.filter(seat => modalSelectedSeatIds.includes(seat.id));
            let total = info.reduce((sum, seat) => sum + ((seat.price && !isNaN(seat.price)) ? parseInt(seat.price) : 0), 0);
            const modalSelectedSeatsDiv = document.getElementById('modal-selected-seats');
            if (modalSelectedSeatsDiv) {
                if(info.length) {
    const seatNumbers = info.map(s => s.seat_number).join('-');
    const totalPrice = total.toLocaleString();
    modalSelectedSeatsDiv.innerHTML = `<b>Ghế đã chọn:</b> ${seatNumbers} (${totalPrice}đ)`;
} else {
    modalSelectedSeatsDiv.innerHTML = '';
}
            }
        }
        function updateSelectedSeats() {
            const info = seatData.filter(seat => selectedSeatIds.includes(seat.id));
            let total = info.reduce((sum, seat) => sum + ((seat.price && !isNaN(seat.price)) ? parseInt(seat.price) : 0), 0);
            const selectedSeatsDiv = document.getElementById('selected-seats');
            if (selectedSeatsDiv) {
                if(info.length) {
                    const seatNumbers = info.map(s => s.seat_number).join('-');
                    const totalPrice = total.toLocaleString();
                    selectedSeatsDiv.innerHTML = `<b>Ghế đã chọn:</b> ${seatNumbers} (${totalPrice}đ)`;
                } else {
                    selectedSeatsDiv.innerHTML = '';
                }
            }
        }
        </script>
        <div class="mb-3">
            <label for="customer_name" class="form-label">Tên khách hàng:</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Số điện thoại:</label>
            <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
        </div>
        <input type="hidden" name="status" value="unpaid">
        <button type="submit" class="btn btn-primary">Xác nhận đặt vé</button>
    </form>
</div>
@endsection
