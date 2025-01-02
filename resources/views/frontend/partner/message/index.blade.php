@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Messages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Chat Box</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="card" style="height: 70vh;">
                        <div class="card-header">
                            <h4>Tất cả</h4>
                            <input type="text" id="chat-search" class="form-control mt-2"
                                placeholder="Tìm kiếm người dùng...">
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border" id="user-list">
                                @foreach ($messages as $mess)
                                    <li class="media chat-user-profile" data-id="{{ $mess->id }}">
                                        <img alt="image"
                                            class="mr-3 rounded-circle {{ $mess->hasSentMessage ? 'msg-notification' : '' }} "
                                            width="50" src="{{ asset($mess->image) }}">
                                        <div class="media-body">
                                            <div class="mt-0 mb-1 font-weight-bold chat-user-name">{{ $mess->name }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card chat-box d-none" id="mychatbox" style="height: 70vh;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 id="chat-inbox-title">Chat</h4>
                            <div class="btn-group" role="group" aria-label="Transaction Buttons">
                                <button type="button" class="btn btn-primary create-transaction ms-1" data-toggle="modal"
                                    data-reciver-id="" data-target="#staticBackdrop">
                                    Tạo giao dịch
                                </button>
                                <button type="button" class="btn btn-success view-transaction">
                                    Xem giao dịch
                                </button>
                            </div>
                        </div>


                        <div class="card-body chat-content" id="chat-content" data-inbox="">
                        </div>
                        <div class="card-footer chat-form">
                            <form id="message-form">
                                <div class="input-group">
                                    <input type="text" class="form-control message-box" placeholder="Nhập tin nhắn"
                                        name="message" autocomplete="off">
                                    <input type="hidden" name="receiver_id" value="" id="receiver_id">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary send-button" type="submit">
                                            <i class="far fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" class="text-center">Tạo Giao Dịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="container mt-5">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h3>Thông Tin Giao Dịch</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="transaction_name">Tên Giao Dịch</label>
                                        <input type="text" name="transaction_name" id="transaction_name"
                                            class="form-control" placeholder="Nhập tên giao dịch" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="transaction_date">Ngày Giao Dịch</label>
                                        <input type="date" name="transaction_date" id="transaction_date"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="transaction_address">Địa chỉ</label>
                                        <input name="transaction_" id="transaction_address" class="form-control"
                                            placeholder="Nhập mô tả địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="transaction_description">Mô Tả</label>
                                        <textarea name="transaction_description" id="transaction_description" class="form-control" rows="3"
                                            placeholder="Nhập mô tả giao dịch"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Thông tin Bên A và Bên B -->
                            <div class="card">
                                <div class="card-header bg-secondary text-white text-center">
                                    <h3>Thông Tin Hai Bên</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Thông tin Bên A -->
                                        <div class="col-md-6 border-right">
                                            <h4 class="text-center">Bên A</h4>
                                            <div class="form-group">
                                                <label for="party_a_name">Tên Công Ty Bên A</label>
                                                <input type="text" name="party_a_name" id="party_a_name"
                                                    class="form-control" placeholder="Nhập tên bên A" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_a_email">Người Đại Diện Bên A</label>
                                                <input type="text" name="party_a_representative"
                                                    id="party_a_representative" class="form-control"
                                                    placeholder="Nhập người đại diện bên A" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_a_email">Số Điện Thoại Bên A</label>
                                                <input type="text" name="party_a_email" id="party_a_email"
                                                    class="form-control" placeholder="Nhập email bên A" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_a_phone">Số Điện Thoại Bên A</label>
                                                <input type="text" name="party_a_phone" id="party_a_phone"
                                                    class="form-control" placeholder="Nhập số điện thoại bên A" required>
                                            </div>

                                        </div>

                                        <!-- Thông tin Bên B -->
                                        <div class="col-md-6">
                                            <h4 class="text-center">Bên B</h4>
                                            <div class="form-group">
                                                <label for="party_b_name">Tên Công Ty Bên B</label>
                                                <input type="text" name="party_b_name" id="party_b_name"
                                                    class="form-control" placeholder="Nhập tên bên B" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_b_email">Người Đại Diện Bên B</label>
                                                <input type="text" name="party_b_representative"
                                                    id="party_b_representative" class="form-control"
                                                    placeholder="Nhập người đại diện bên B" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_b_email">Số Điện Thoại Bên A</label>
                                                <input type="text" name="party_b_email" id="party_b_email"
                                                    class="form-control" placeholder="Nhập email bên B" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="party_b_phone">Số Điện Thoại Bên B</label>
                                                <input type="text" name="party_b_phone" id="party_b_phone"
                                                    class="form-control" placeholder="Nhập số điện thoại bên B" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary transaction">Tạo Giao Dịch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        #chat-content {
            height: calc(70vh - 100px);
            overflow-y: auto;
        }

        #chat-search {
            width: 100%;
            margin-top: 10px;
        }

        .modal-dialog {
            max-width: 800px;
            width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script>
        var recei = "";
        const ChatApp = {
            init() {
                this.bindEvents();
            },

            scrollToBottom() {
                const mainChatInbox = $('#chat-content');
                if (mainChatInbox.length) {
                    mainChatInbox.scrollTop(mainChatInbox.prop('scrollHeight'));
                }
            },
            formatDateTime(dateTimeString) {
                try {
                    const options = {
                        year: 'numeric',
                        month: 'short',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    return new Intl.DateTimeFormat('vi-VN', options).format(new Date(dateTimeString));
                } catch (error) {
                    console.error('Error formatting date:', error);
                    return '';
                }
            },
            bindEvents() {
                $('#user-list').on('click', '.chat-user-profile', this.handleUserClick);
                $('#message-form').on('submit', this.handleSendMessage);
                $('#chat-search').on('input', this.handleSearchUser);
            },
            handleSearchUser(event) {
                const searchValue = $(event.target).val().toLowerCase();
                $('#user-list .chat-user-profile').each(function() {
                    const userName = $(this).find('.chat-user-name').text().toLowerCase();
                    if (userName.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            },
            handleUserClick(event) {
                const receiverId = $(this).data('id');
                const name = $(this).find('.chat-user-name').text();
                const chatBox = $('#mychatbox');
                recei = receiverId;
                const receiverIdInput = $('#receiver_id');
                $(this).find('.rounded-circle').removeClass('msg-notification');
                chatBox.removeClass('d-none');
                $('#chat-inbox-title').text(`Chat với ${name}`);
                receiverIdInput.val(receiverId);
                ChatApp.readMessage(receiverId);
                try {
                    window.Echo.private(`chat.${USER.id}`)
                        .listen('MessageSent', ChatApp.handleNewMessage);
                } catch (error) {
                    console.error('Error initializing Echo listener:', error);
                }
                ChatApp.fetchMessages(receiverId);
            },
            handleSendMessage(event) {
                event.preventDefault();
                const messageContent = $('.message-box').val();

                if (!messageContent.trim()) return;

                $.ajax({
                    url: '{{ route('user.message.send-message') }}',
                    method: 'POST',
                    data: {
                        message: messageContent,
                        receiver_id: $('#receiver_id').val()
                    },
                    success: function(response) {
                        ChatApp.appendMessage(response.data, 'chat-right');
                        $('.message-box').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending message:', error);
                    }
                });
            },
            handleNewMessage(event) {
                console.log('New message received:', event);
                const currentReceiverId = $('#receiver_id').val();
                const senderId = event.sender_id;
                const receiverId = event.receiver_id;

                if (currentReceiverId !== senderId.toString()) {
                    const chatListItem = $(`.chat-user-profile[data-id="${senderId}"]`);
                    chatListItem.find('img').addClass('msg-notification');
                    return;
                }
                ChatApp.appendMessage({
                    content: event.content,
                    created_at: event.date_time
                }, 'chat-left');

                ChatApp.scrollToBottom();
                ChatApp.readMessage(senderId);
            },
            fetchMessages(receiverId) {
                const mainChatInbox = $('#chat-content');
                $.ajax({
                    url: '{{ route('user.message.getMessages') }}',
                    type: 'GET',
                    data: {
                        id: receiverId
                    },
                    beforeSend: function() {
                        mainChatInbox.html('');
                    },
                    success: function(response) {

                        response.data.forEach(function(value) {
                            ChatApp.appendMessage(value, value.sender_id == USER.id ? 'chat-right' :
                                'chat-left');
                        });
                        ChatApp.scrollToBottom();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading messages:', error);
                    }
                });
            },
            appendMessage(message, alignment) {
                const chatItem = `
                <div class="chat-item ${alignment}">
                    <div class="chat-details">
                        <div class="chat-text">${message.content}</div>
                        <div class="chat-time">${ChatApp.formatDateTime(message.created_at)}</div>
                    </div>
                </div>`;
                $('#chat-content').append(chatItem);
                $('#chat-content').scrollTop($('#chat-content').prop('scrollHeight'));
            },
            readMessage(receiverId) {
                $.ajax({
                    url: '{{ route('user.message.read') }}',
                    type: 'POST',
                    data: {
                        receiver_id: receiverId
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $(`.chat-user-profile[data-id="${receiverId}"] .rounded-circle`).removeClass(
                                'msg-notification');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error reading message:', error);
                    }
                });
            },
        };


        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.create-transaction').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('user.message.fillInformation') }}',
                    method: 'GET',
                    data: {
                        company: recei
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            console.log(response.data);
                            $('#party_a_representative').val(response.data.company_a[0]
                                .representative);
                            $('#party_a_name').val(response.data.company_a[0].company_name);
                            $('#party_a_phone').val(response.data.company_a[0].phone_number);
                            $('#party_a_email').val(response.data.company_a[0].email);

                            $('#party_b_representative').val(response.data.company_b[0]
                                .representative);
                            $('#party_b_name').val(response.data.company_b[0].company_name);
                            $('#party_b_phone').val(response.data.company_b[0].phone_number);
                            $('#party_b_email').val(response.data.company_b[0].email);
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending message:', error);
                    }
                });
            });
            $('.transaction').on('click', function(e) {
                e.preventDefault();

                let transactionDate = new Date($('#transaction_date').val()); // Lấy ngày giao dịch
                let currentDate = new Date(); // Ngày hiện tại

                // Đặt thời gian của currentDate về 00:00:00 để chỉ so sánh ngày
                currentDate.setHours(0, 0, 0, 0);

                if (transactionDate < currentDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Ngày giao dịch không được nhỏ hơn ngày hiện tại!',
                    });
                    return;
                }

                // Kiểm tra nếu bất kỳ trường nào bị bỏ trống
                if ($('#transaction_name').val().trim() === "" ||
                    $('#transaction_date').val().trim() === "" ||
                    $('#transaction_address').val().trim() === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Vui lòng điền đầy đủ thông tin!',
                    });
                    return;
                }

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('user.message.createTransaction') }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: $('#transaction_name').val(),
                        date_meet: $('#transaction_date').val(),
                        address: $('#transaction_address').val(),
                        content: $('#transaction_description').val(),
                        receiver_id: recei,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: response.message,
                            });
                            $('#staticBackdrop').modal('hide');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: xhr.responseJSON?.message ||
                                'Đã xảy ra lỗi, vui lòng thử lại sau!',
                        });
                        console.error('Error sending message:', error);
                    }
                });
            });


            $('.view-transaction').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('user.message.getTransaction') }}',
                    method: 'GET',
                    data: {
                        receiver_id: recei,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            const transactions = response.data
                                .data; // Giả sử mảng nằm trong response.data.data
                            let transactionHtml = '';

                            transactions.forEach((transaction, index) => {
                                const formattedDate = formatDate(transaction.date_meet);

                                transactionHtml += `
                        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9f9f9; text-align: left;">
                            <h4 style="margin-bottom: 10px; color: #333; text-align: left;">Giao dịch ${index + 1}</h4>
                            <div style="margin-bottom: 8px; text-align: left;">
                                <span style="font-weight: bold; color: #555;">Tên giao dịch:</span>
                                <span>${transaction.title}</span>
                            </div>
                            <div style="margin-bottom: 8px; text-align: left;">
                                <span style="font-weight: bold; color: #555;">Ngày giao dịch:</span>
                                <span>${formattedDate}</span>
                            </div>
                            <div style="margin-bottom: 8px; text-align: left;">
                                <span style="font-weight: bold; color: #555;">Địa chỉ:</span>
                                <span>${transaction.address}</span>
                            </div>
                            <div style="margin-bottom: 8px; text-align: left;">
                                <span style="font-weight: bold; color: #555;">Nội dung:</span>
                                <span>${transaction.content}</span>
                            </div>
                            <div style="margin-bottom: 8px; text-align: left;">
                                <span style="font-weight: bold; color: #555;">Bên A:</span>
                                <span>${transaction.company_sender_company_name} (${transaction.company_sender_name})</span>
                            </div>
                            <div style="text-align: left;">
                                <span style="font-weight: bold; color: #555;">Bên B:</span>
                                <span>${transaction.company_receiver_company_name} (${transaction.company_receiver_name})</span>
                            </div>
                        </div>
                    `;
                            });

                            Swal.fire({
                                title: 'Thông tin giao dịch',
                                html: transactionHtml,
                                icon: 'info',
                                width: '700px',
                                customClass: {
                                    popup: 'swal-transaction-popup',
                                },
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching transaction details:', error);
                    },
                });

                // Hàm format ngày
                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const day = String(date.getDate()).padStart(2,
                        '0'); // Lấy ngày, thêm số 0 nếu nhỏ hơn 10
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Lấy tháng (bắt đầu từ 0)
                    const year = date.getFullYear(); // Lấy năm
                    return `${day}-${month}-${year}`; // Trả về định dạng dd-mm-yyyy
                }
            });

            ChatApp.init();
        });
    </script>
@endpush
