<?php

require_once('Language.php');
require_once('en_gb.php');

class vn_vn extends en_gb
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    protected function _LoadStrings()
    {
        $strings = [];

        $strings['FirstName'] = 'Họ';
        $strings['LastName'] = 'Tên';
        $strings['Timezone'] = 'Múi Giờ';
        $strings['Edit'] = 'Chỉnh Sửa';
        $strings['Change'] = 'Thay Đổi';
        $strings['Rename'] = 'Đổi tên';
        $strings['Remove'] = 'Xóa bỏ';
        $strings['Delete'] = 'Xóa';
        $strings['Update'] = 'Cập nhật';
        $strings['Cancel'] = 'Hủy';
        $strings['Add'] = 'Thêm';
        $strings['Name'] = 'Tên';
        $strings['Yes'] = 'Có';
        $strings['No'] = 'Không';
        $strings['FirstNameRequired'] = 'Yêu cầu phải có Họ.';
        $strings['LastNameRequired'] = 'Yêu cầu phải có Tên.';
        $strings['PwMustMatch'] = 'Mật khẩu xác nhận phải trùng với mật khẩu vừa đánh.';
        $strings['ValidEmailRequired'] = 'Yêu cầu phải có địa chỉ e-mail tồn tại để xác thực.';
        $strings['UniqueEmailRequired'] = 'Địa chỉ E-mail đã được đăng ký.';
        $strings['UniqueUsernameRequired'] = 'Tên đăng nhập đã được đăng ký.';
        $strings['UserNameRequired'] = 'Yêu cầu phải có username.';
        $strings['CaptchaMustMatch'] = 'Vui lòng đền đúng những ký tự mà bạn thấy dưới ảnh.';
        $strings['Today'] = 'Ngày hôm nay';
        $strings['Week'] = 'Tuần';
        $strings['Month'] = 'Tháng';
        $strings['BackToCalendar'] = 'Quay trở lại Lịch';
        $strings['BeginDate'] = 'Bắt đầu';
        $strings['EndDate'] = 'Kết thúc';
        $strings['Username'] = 'Tên đăng nhập';
        $strings['Password'] = 'Mật khẩu';
        $strings['PasswordConfirmation'] = 'Xác nhận mật khẩu';
        $strings['DefaultPage'] = 'Trang chủ mặc định';
        $strings['MyCalendar'] = 'Lịch của tôi';
        $strings['ScheduleCalendar'] = 'Lịch';
        $strings['Registration'] = 'Đăng Ký';
        $strings['NoAnnouncements'] = 'Không có thông báo mới';
        $strings['Announcements'] = 'Thông Báo';
        $strings['NoUpcomingReservations'] = 'Bạn không có đặt phòng sắp tới';
        $strings['UpcomingReservations'] = 'Đặt phòng sắp tới';
        $strings['AllNoUpcomingReservations'] = 'Không có phòng chức năng nào đến %s ngày tiếp theo';
        $strings['AllUpcomingReservations'] = 'Tất cả đặt phòng sắp tới';
        $strings['ShowHide'] = 'Hiện/Ẩn';
        $strings['Error'] = 'Lỗi !';
        $strings['ReturnToPreviousPage'] = 'Quay lại trang cuối cùng mà bạn đã truy cập';
        $strings['UnknownError'] = 'Lỗi chưa xác định';
        $strings['InsufficientPermissionsError'] = 'Lỗi ! Bạn phải đăng nhập vào hệ thống để có thể đặt phòng';
        $strings['MissingReservationResourceError'] = 'Chưa chọn phòng chức năng';
        $strings['MissingReservationScheduleError'] = 'Chưa chọn khung giờ';
        $strings['DoesNotRepeat'] = 'Không lặp lại';
        $strings['Daily'] = 'Hàng ngày';
        $strings['Weekly'] = 'Hàng Tuần';
        $strings['Monthly'] = 'Hàng Tháng';
        $strings['Yearly'] = 'Hàng Năm';
        $strings['RepeatPrompt'] = 'Lặp lại';
        $strings['hours'] = 'Giờ';
        $strings['days'] = 'Ngày';
        $strings['weeks'] = 'Tuần';
        $strings['months'] = 'Tháng';
        $strings['years'] = 'Năm';
        $strings['day'] = 'Ngày';
        $strings['week'] = 'Tuần';
        $strings['month'] = 'Tháng';
        $strings['year'] = 'Năm';
        $strings['repeatDayOfMonth'] = 'Ngày trong tháng';
        $strings['repeatDayOfWeek'] = 'Ngày trong tuần';
        $strings['RepeatUntilPrompt'] = 'Cho đến khi';
        $strings['RepeatEveryPrompt'] = 'Mỗi';
        $strings['RepeatDaysPrompt'] = 'Vào các ngày';
        $strings['CreateReservationHeading'] = 'Đặt phòng mới';
        $strings['EditReservationHeading'] = 'Sửa phòng chức năng %s';
        $strings['ViewReservationHeading'] = 'Xem phòng chức năng %s';
        $strings['ReservationErrors'] = 'Đổi đặt phòng';
        $strings['Create'] = 'Tạo mới';
        $strings['ThisInstance'] = 'Chỉ phiên này';
        $strings['AllInstances'] = 'Tất cả các phiên';
        $strings['FutureInstances'] = 'Các phiên sắp tới';
        $strings['Print'] = 'In';
        $strings['ShowHideNavigation'] = 'Hiện/Ẩn thanh điều hướng';
        $strings['ReferenceNumber'] = 'Mã tham chiếu';
        $strings['Tomorrow'] = 'Ngày Mai';
        $strings['LaterThisWeek'] = 'Cuối tuần này';
        $strings['NextWeek'] = 'Tuần tới';
        $strings['SignOut'] = 'Đăng xuất';
        $strings['LayoutDescription'] = 'Bắt đầu từ %s, hiển thị %s ngày mỗi lần';
        $strings['AllResources'] = 'Tất cả phòng chức năng';
        $strings['TakeOffline'] = 'Ngừng hoạt động';
        $strings['BringOnline'] = 'Kích hoạt lại';
        $strings['AddImage'] = 'Thêm Ảnh';
        $strings['NoImage'] = 'Không có ảnh';
        $strings['Move'] = 'Thay đổi';
        $strings['AppearsOn'] = 'Xuất hiện vào %s';
        $strings['Location'] = 'Vị trí';
        $strings['NoLocationLabel'] = '(Vị trí chưa được cài đặt)';
        $strings['Contact'] = 'Liên Hệ';
        $strings['NoContactLabel'] = '(Không có thông tin liên hệ)';
        $strings['Description'] = 'Mô tả ngắn';
        $strings['NoDescriptionLabel'] = '(Mô tả ngắn)';
        $strings['Notes'] = 'Ghi Chú';
        $strings['NoNotesLabel'] = '(Không có ghi chú nào)';
        $strings['NoTitleLabel'] = '(Không có tiêu đề)';
        $strings['UsageConfiguration'] = 'Sử dụng cấu hình này';
        $strings['ChangeConfiguration'] = 'Thay đổi cấu hình';
        $strings['ResourceMinLength'] = 'Đặt phòng phải kéo dài ít nhất %s';
        $strings['ResourceMinLengthNone'] = 'Không có thời gian đặt phòng tối thiểu';
        $strings['ResourceMaxLength'] = 'Đặt phòng không thể kéo dài hơn %s';
        $strings['ResourceMaxLengthNone'] = 'Không có thời gian đặt phòng tối đa';
        $strings['ResourceRequiresApproval'] = 'Đặt phòng cần được phê duyệt';
        $strings['ResourceRequiresApprovalNone'] = 'Đặt phòng không cần phê duyệt';
        $strings['ResourcePermissionAutoGranted'] = 'Quyền được tự động cấp';
        $strings['ResourcePermissionNotAutoGranted'] = 'Quyền không được tự động cấp';
        $strings['ResourceMinNotice'] = 'Đặt phòng phải được đặt trước ít nhất %s so với thời gian bắt đầu';
        $strings['ResourceMinNoticeNone'] = 'Đặt phòng có thể được đặt cho đến thời điểm hiện tại';
        $strings['ResourceMinNoticeUpdate'] = 'Đặt phòng phải được cập nhật ít nhất %s trước giờ bắt đầu';
        $strings['ResourceMinNoticeNoneDelete'] = 'Đặt phòng có thể được xóa cho đến thời điểm hiện tại';
        $strings['ResourceMinNoticeDelete'] = 'Đặt phòng phải được xóa ít nhất %s trước giờ bắt đầu';
        $strings['ResourceMaxNotice'] = 'Đặt phòng không được kết thúc muộn hơn %s so với thời điểm hiện tại';
        $strings['ResourceMaxNoticeNone'] = 'Đặt phòng có thể kết thúc bất kỳ lúc nào trong tương lai';
        $strings['ResourceBufferTime'] = 'Phải có khoảng trống %s giữa các đặt phòng';
        $strings['ResourceBufferTimeNone'] = 'Không có khoảng trống giữa các đặt phòng';
        $strings['ResourceAllowMultiDay'] = 'Đặt phòng có thể đặt qua nhiều ngày';
        $strings['ResourceNotAllowMultiDay'] = 'Đặt phòng không thể đặt qua nhiều ngày';
        $strings['ResourceCapacity'] = 'Phòng này có sức chứa tối đa %s người';
        $strings['ResourceCapacityNone'] = 'Phòng này có sức chứa không giới hạn';
        $strings['AddNewResource'] = 'Tạo phòng chức năng mới';
        $strings['AddNewUser'] = 'Thêm Người dùng mới';
        $strings['AddResource'] = 'Thêm phòng chức năng';
        $strings['Capacity'] = 'Sức chứa';
        $strings['Access'] = 'Quyền truy cập';
        $strings['Duration'] = 'Thời lượng';
        $strings['Active'] = 'Kích hoạt';
        $strings['Inactive'] = 'Bỏ kích hoạt';
        $strings['ResetPassword'] = 'Khôi phục mật khẩu';
        $strings['LastLogin'] = 'Lần đăng nhập trước';
        $strings['Search'] = 'Tìm kiếm';
        $strings['ResourcePermissions'] = 'Quyền truy cập phòng chức năng';
        $strings['Reservations'] = 'Đặt phòng';
        $strings['Groups'] = 'Nhóm';
        $strings['Users'] = 'Người dùng';
        $strings['AllUsers'] = 'Tất cả người dùng';
        $strings['AllGroups'] = 'Tất cả các nhóm';
        $strings['AllSchedules'] = 'Tất cả các phòng chức năng';
        $strings['UsernameOrEmail'] = 'Tên đăng nhập hoặc Email';
        $strings['Members'] = 'Thành viên';
        $strings['QuickSlotCreation'] = 'Tạo khung giờ mỗi %s phút từ %s đến %s';
        $strings['ApplyUpdatesTo'] = 'Áp dụng cập nhật cho';
        $strings['CancelParticipation'] = 'Hủy tham gia phòng chức năng';
        $strings['Attending'] = 'Tham dự';
        $strings['QuotaConfiguration'] = 'Vào %s, tối đa %s người dùng trong %s có thể đặt tối đa %s %s mỗi %s';
        $strings['QuotaEnforcement'] = 'Thi hành %s %s';
        $strings['reservations'] = 'Đặt phòng';
        $strings['reservation'] = 'Đặt phòng';
        $strings['ChangeCalendar'] = 'Đổi phòng';
        $strings['AddQuota'] = 'Thêm định mức';
        $strings['FindUser'] = 'Tìm người dùng';
        $strings['Created'] = 'Đã tạo';
        $strings['LastModified'] = 'Lần thay đổi gần đây';
        $strings['GroupName'] = 'Tên Nhóm';
        $strings['GroupMembers'] = 'Thành Viên Nhóm';
        $strings['GroupRoles'] = 'Quyền hạn Nhóm';
        $strings['GroupAdmin'] = 'Quản trị viên Nhóm';
        $strings['Actions'] = 'Hành động';
        $strings['CurrentPassword'] = 'Mật khẩu hiện tại';
        $strings['NewPassword'] = 'Mật khẩu mới';
        $strings['InvalidPassword'] = 'Mật khẩu hiện tại không đúng';
        $strings['PasswordChangedSuccessfully'] = 'Mật khẩu đã được đổi thành công';
        $strings['SignedInAs'] = 'Đăng nhập với tư cách';
        $strings['NotSignedIn'] = 'Bạn chưa đăng nhập...';
        $strings['ReservationTitle'] = 'Tiêu đề cuộc họp';
        $strings['ReservationDescription'] = 'Mô tả ngắn về cuộc họp';
        $strings['ResourceList'] = 'Danh sách phòng chức năng cần đặt';
        $strings['Accessories'] = 'Trang thiết bị cần cho cuộc họp:';
        $strings['InvitationList'] = 'Danh sách khách mời';
        $strings['AccessoryName'] = 'Thiết bị/Phụ kiện';
        $strings['QuantityAvailable'] = 'Số lượng hiện có: ';
        $strings['Resources'] = 'Phòng chức năng';
        $strings['Participants'] = 'Người tham dự';
        $strings['User'] = 'Người dùng';
        $strings['Resource'] = 'Phòng chức năng';
        $strings['Status'] = 'Trạng thái';
        $strings['Approve'] = 'Phê Duyệt';
        $strings['Page'] = 'Trang';
        $strings['Rows'] = 'Dòng';
        $strings['Unlimited'] = 'Không giới hạn';
        $strings['Email'] = 'Email';
        $strings['EmailAddress'] = 'Địa chỉ E-mail';
        $strings['Phone'] = 'Số điện thoại';
        $strings['Organization'] = 'Phòng Ban';
        $strings['Position'] = 'Vị Trí';
        $strings['Language'] = 'Ngôn Ngữ';
        $strings['Permissions'] = 'Quyền hạn';
        $strings['Reset'] = 'Khôi phục';
        $strings['FindGroup'] = 'Tìm nhóm';
        $strings['Manage'] = 'Quản lý';
        $strings['None'] = 'Không có';
        $strings['AddToOutlook'] = 'Thêm vào Lịch';
        $strings['Done'] = 'Xong';
        $strings['RememberMe'] = 'Ghi nhớ đăng nhập';
        $strings['FirstTimeUser?'] = 'Đây là lần đầu tiên bạn sử dụng hệ thống?';
        $strings['CreateAnAccount'] = 'Tạo một tài khoản mới';
        $strings['ViewSchedule'] = 'Xem phòng chức năng';
        $strings['ForgotMyPassword'] = 'Quên mật khẩu?';
        $strings['YouWillBeEmailedANewPassword'] = 'Hệ thống sẽ tự động gửi mật khẩu vào e-mail cho bạn.';
        $strings['Close'] = 'Đóng';
        $strings['ExportToCSV'] = 'Xuất file sang CSV';
        $strings['OK'] = 'OK';
        $strings['Working'] = 'Đang xử lý...';
        $strings['Login'] = 'Đăng Nhập';
        $strings['AdditionalInformation'] = 'Thông tin thêm';
        $strings['AllFieldsAreRequired'] = 'Vui lòng nhập đầy đủ thông tin';
        $strings['Optional'] = 'Tùy chọn';
        $strings['YourProfileWasUpdated'] = 'Hồ sơ của bạn đã được cập nhật.';
        $strings['YourSettingsWereUpdated'] = 'Cấu hình của bạn đã được cập nhật.';
        $strings['Register'] = 'Đăng ký';
        $strings['SecurityCode'] = 'Mã bảo mật';
        $strings['ReservationCreatedPreference'] = 'Khi tôi tạo đặt phòng hoặc đặt phòng được tạo thay mặt tôi';
        $strings['ReservationUpdatedPreference'] = 'Khi tôi cập nhật đặt phòng hoặc đặt phòng được cập nhật thay mặt tôi';
        $strings['ReservationDeletedPreference'] = 'Khi tôi xóa đặt phòng hoặc đặt phòng bị xóa thay mặt tôi';
        $strings['ReservationApprovalPreference'] = 'Khi đặt phòng đang chờ phê duyệt của tôi được chấp thuận';
        $strings['ReservationParticipationActivityPreference'] = 'Khi ai đó tham gia hoặc rời khỏi đặt phòng của tôi';
        $strings['ReservationSeriesEndingPreference'] = 'Khi chuỗi đặt phòng định kỳ của tôi kết thúc';
        $strings['PreferenceSendEmail'] = 'Gửi E-mail cho tôi';
        $strings['PreferenceNoEmail'] = 'Không gửi thông báo cho tôi';
        $strings['ReservationCreated'] = 'Đặt phòng của bạn đã được tạo thành công!';
        $strings['ReservationUpdated'] = 'Đặt phòng của bạn đã được cập nhật thành công!';
        $strings['ReservationRemoved'] = 'Đặt phòng của bạn đã bị xóa';
        $strings['ReservationRequiresApproval'] = 'Một hoặc nhiều phòng chức năng được đặt cần được phê duyệt trước khi sử dụng. Đặt phòng này sẽ ở trạng thái chờ cho đến khi được phê duyệt.';
        $strings['YourReferenceNumber'] = 'Mã tham chiếu của bạn là %s';
        $strings['ChangeUser'] = 'Đổi Người dùng';
        $strings['MoreResources'] = 'Xem thêm phòng chức năng';
        $strings['ReservationLength'] = 'Thời gian họp là: ';
        $strings['ParticipantList'] = 'Danh sách người tham dự họp:';
        $strings['AddParticipants'] = 'Thêm người tham dự';
        $strings['InviteOthers'] = 'Thêm người họp khác:';
        $strings['AddResources'] = 'Tất cả các phòng chức năng:';
        $strings['AddAccessories'] = 'Thêm trang thiết bị:';
        $strings['Accessory'] = 'Trang thiết bị';
        $strings['QuantityRequested'] = 'Số lượng yêu cầu';
        $strings['CreatingReservation'] = 'Tạo cuộc họp mới';
        $strings['UpdatingReservation'] = 'Cập nhật thông tin cuộc họp';
        $strings['DeleteWarning'] = 'Đây là hành động vĩnh viễn và không thể khôi phục!';
        $strings['DeleteAccessoryWarning'] = 'Xóa trang thiết bị này sẽ xóa nó khỏi tất cả các đặt phòng.';
        $strings['AddAccessory'] = 'Thêm Trang thiết bị';
        $strings['AddBlackout'] = 'Tạo lịch trùng giờ';
        $strings['AllResourcesOn'] = 'Tất cả các phòng chức năng';
        $strings['Reason'] = 'Lý do';
        $strings['BlackoutShowMe'] = 'Hiện phòng chức năng bị trùng giờ';
        $strings['BlackoutDeleteConflicts'] = 'Xóa phòng chức năng bị trùng giờ';
        $strings['Filter'] = 'Tìm kiếm';
        $strings['Between'] = 'Trong khoảng';
        $strings['CreatedBy'] = 'Được tạo bởi';
        $strings['BlackoutCreated'] = 'Lịch trùng giờ đã được tạo';
        $strings['BlackoutNotCreated'] = 'Không thể tạo lịch trùng giờ';
        $strings['BlackoutUpdated'] = 'Lịch trùng giờ đã được cập nhật';
        $strings['BlackoutNotUpdated'] = 'Không thể cập nhật lịch trùng giờ';
        $strings['BlackoutConflicts'] = 'Có lịch trùng giờ khác';
        $strings['ReservationConflicts'] = 'Có đặt phòng khác bị trùng giờ';
        $strings['UsersInGroup'] = 'Người dùng trong nhóm này';
        $strings['Browse'] = 'Duyệt';
        $strings['DeleteGroupWarning'] = 'Xóa nhóm này sẽ loại bỏ tất cả quyền truy cập phòng chức năng được liên kết. Người dùng trong nhóm này có thể mất quyền truy cập vào phòng chức năng.';
        $strings['WhatRolesApplyToThisGroup'] = 'Nhóm này được áp dụng các quyền nào?';
        $strings['WhoCanManageThisGroup'] = 'Ai có thể quản lý nhóm này?';
        $strings['WhoCanManageThisSchedule'] = 'Ai có thể quản lý lịch này?';
        $strings['AllQuotas'] = 'Tất cả hạn mức';
        $strings['QuotaReminder'] = 'Lưu ý: Hạn mức được áp dụng dựa trên múi giờ của lịch.';
        $strings['AllReservations'] = 'Tất cả đặt phòng';
        $strings['PendingReservations'] = 'Đặt phòng đang chờ phê duyệt';
        $strings['Approving'] = 'Đang phê duyệt';
        $strings['MoveToSchedule'] = 'Chuyển đến lịch';
        $strings['DeleteResourceWarning'] = 'Xóa phòng chức năng này sẽ xóa tất cả dữ liệu liên quan, bao gồm';
        $strings['DeleteResourceWarningReservations'] = 'tất cả các đặt phòng trước đây, hiện tại và tương lai được liên kết với nó';
        $strings['DeleteResourceWarningPermissions'] = 'tất cả các quyền được gán';
        $strings['DeleteResourceWarningReassign'] = 'Vui lòng gán lại bất kỳ thứ gì bạn không muốn xóa trước khi tiếp tục';
        $strings['ScheduleLayout'] = 'Bố cục (tất cả thời gian %s)';
        $strings['ReservableTimeSlots'] = 'Các khung giờ có thể đặt phòng';
        $strings['BlockedTimeSlots'] = 'Các khung giờ bị chặn';
        $strings['ThisIsTheDefaultSchedule'] = 'Đây là lịch mặc định';
        $strings['DefaultScheduleCannotBeDeleted'] = 'Không thể xóa lịch mặc định';
        $strings['MakeDefault'] = 'Đặt làm mặc định';
        $strings['BringDown'] = 'Thu nhỏ';
        $strings['ChangeLayout'] = 'Thay đổi bố cục';
        $strings['AddSchedule'] = 'Thêm lịch';
        $strings['StartsOn'] = 'Bắt đầu từ';
        $strings['NumberOfDaysVisible'] = 'Số ngày hiển thị';
        $strings['UseSameLayoutAs'] = 'Sử dụng cùng bố cục với';
        $strings['Format'] = 'Định dạng';
        $strings['OptionalLabel'] = 'Nhãn tùy chọn';
        $strings['LayoutInstructions'] = 'Nhập một khung giờ trên mỗi dòng. Khung giờ phải được cung cấp cho tất cả 24 giờ trong ngày, bắt đầu và kết thúc lúc 12:00 SA.';
        $strings['AddUser'] = 'Thêm người dùng';
        $strings['UserPermissionInfo'] = 'Quyền truy cập thực tế vào phòng chức năng có thể khác nhau tùy theo vai trò của người dùng, quyền của nhóm hoặc cài đặt quyền hạn bên ngoài';
        $strings['DeleteUserWarning'] = 'Xóa người dùng này sẽ xóa tất cả đặt phòng hiện tại, tương lai và lịch sử của họ.';
        $strings['AddAnnouncement'] = 'Thêm thông báo';
        $strings['Announcement'] = 'Thông Báo';
        $strings['Priority'] = 'Ưu tiên';
        $strings['Reservable'] = 'Phòng Trống';
        $strings['Unreservable'] = 'Khóa Phòng';
        $strings['Reserved'] = 'Đã đặt phòng';
        $strings['MyReservation'] = 'phòng chức năng của tôi';
        $strings['Pending'] = 'Đang chờ';
        $strings['Past'] = 'TG đã qua';
        $strings['Restricted'] = 'Cấm';
        $strings['ViewAll'] = 'Xem tất cả';
        $strings['MoveResourcesAndReservations'] = 'Thay đổi phòng chức năng và đặt phòng đến';
        $strings['TurnOffSubscription'] = 'Tắt tính năng đăng ký lịch';
        $strings['TurnOnSubscription'] = 'Cho phép đăng ký vào lịch này';
        $strings['SubscribeToCalendar'] = 'Đăng ký lịch này';
        $strings['SubscriptionsAreDisabled'] = 'Quản trị viên đã tắt tính năng đăng ký lịch';
        $strings['NoResourceAdministratorLabel'] = '(Không có Quản trị viên phòng chức năng)';
        $strings['WhoCanManageThisResource'] = 'Ai có thể Quản lý phòng chức năng này?';
        $strings['ResourceAdministrator'] = 'Quản trị viên phòng chức năng';
        $strings['Private'] = 'Riêng Tư';
        $strings['Accept'] = 'Cho phép';
        $strings['Decline'] = 'Từ chối';
        $strings['ShowFullWeek'] = 'Xem phòng chức năng cả tuần';
        $strings['CustomAttributes'] = 'Thuộc tính Tùy chỉnh';
        $strings['AddAttribute'] = 'Thêm Thuộc tính';
        $strings['EditAttribute'] = 'Cập nhật Thuộc tính';
        $strings['DisplayLabel'] = 'Nhãn Hiển thị';
        $strings['Type'] = 'Loại';
        $strings['Required'] = 'Bắt buộc';
        $strings['ValidationExpression'] = 'Biểu thức Kiểm tra';
        $strings['PossibleValues'] = 'Các giá trị khả dụng';
        $strings['SingleLineTextbox'] = 'Nhập liệu 1 dòng';
        $strings['MultiLineTextbox'] = 'Nhập liệu nhiều dòng';
        $strings['Checkbox'] = 'Kiểm tra';
        $strings['SelectList'] = 'Danh sách lựa chọn';
        $strings['CommaSeparated'] = 'ngăn cách bằng dấu phẩy';
        $strings['Category'] = 'Loại';
        $strings['CategoryReservation'] = 'Đặt phòng';
        $strings['CategoryGroup'] = 'Nhóm';
        $strings['SortOrder'] = 'Thứ tự sắp xếp';
        $strings['Title'] = 'Tiêu đề';
        $strings['AdditionalAttributes'] = 'Thuộc tính bổ sung';
        $strings['True'] = 'Đúng';
        $strings['False'] = 'Sai';
        $strings['ForgotPasswordEmailSent'] = 'Một email đã được gửi đến địa chỉ được cung cấp với hướng dẫn đặt lại mật khẩu của bạn.';
        $strings['ActivationEmailSent'] = 'Bạn sẽ sớm nhận được email kích hoạt.';
        $strings['AccountActivationError'] = 'Rất tiếc, chúng tôi không thể kích hoạt tài khoản của bạn.';
        $strings['Attachments'] = 'Tệp đính kèm';
        $strings['AttachFile'] = 'Đính kèm tệp';
        $strings['Maximum'] = 'tối đa';
        $strings['NoScheduleAdministratorLabel'] = 'Không có Quản trị viên Lịch';
        $strings['ScheduleAdministrator'] = 'Quản trị viên Lịch';
        $strings['Total'] = 'Tổng';
        $strings['QuantityReserved'] = 'Số lượng đã đặt';
        $strings['AllAccessories'] = 'Tất cả Trang thiết bị';
        $strings['GetReport'] = 'Xuất Báo cáo';
        $strings['NoResultsFound'] = 'Không tìm thấy kết quả phù hợp';
        $strings['SaveThisReport'] = 'Lưu Báo cáo này';
        $strings['ReportSaved'] = 'Báo cáo đã được lưu!';
        $strings['EmailReport'] = 'Gửi email Báo cáo';
        $strings['ReportSent'] = 'Đã gửi báo cáo!';
        $strings['RunReport'] = 'Chạy Báo cáo';
        $strings['NoSavedReports'] = 'Bạn không có báo cáo nào đã lưu.';
        $strings['CurrentWeek'] = 'Tuần hiện tại';
        $strings['CurrentMonth'] = 'Tháng hiện tại';
        $strings['AllTime'] = 'Tất cả thời gian';
        $strings['FilterBy'] = 'Lọc theo';
        $strings['Select'] = 'Chọn';
        $strings['List'] = 'Danh sách';
        $strings['TotalTime'] = 'Tổng thời gian';
        $strings['Count'] = 'Số lượng';
        $strings['Usage'] = 'Sử dụng';
        $strings['AggregateBy'] = 'Tổng hợp theo';
        $strings['Range'] = 'Khoảng thời gian';
        $strings['Choose'] = 'Chọn';
        $strings['All'] = 'Tất cả các phòng';
        $strings['ViewAsChart'] = 'Xem Biểu đồ';
        $strings['ReservedResources'] = 'phòng chức năng đã đặt';
        $strings['ReservedAccessories'] = 'Trang thiết bị đã đặt';
        $strings['ResourceUsageTimeBooked'] = 'Sử dụng phòng chức năng - Thời gian đặt';
        $strings['ResourceUsageReservationCount'] = 'Sử dụng phòng chức năng - Số lần đặt';
        $strings['Top20UsersTimeBooked'] = 'Top 20 Người dùng - Thời gian đặt';
        $strings['Top20UsersReservationCount'] = 'Top 20 Người dùng - Số lần đặt';
        $strings['ConfigurationUpdated'] = 'Cập nhật cấu hình thành công';
        $strings['ConfigurationUiNotEnabled'] = 'Không thể truy cập trang này vì $conf[\'settings\'][\'pages\'][\'enable.configuration\'] được đặt thành false hoặc không tồn tại.';
        $strings['ConfigurationFileNotWritable'] = 'Không thể ghi vào file cấu hình. Vui lòng kiểm tra quyền của file này và thử lại.';
        $strings['ConfigurationUpdateHelp'] = 'Tham khảo phần Cấu hình trong <a target=_blank href=%s>Tài liệu Trợ giúp</a> để biết tài liệu về các cài đặt này.';
        $strings['GeneralConfigSettings'] = 'Cài đặt chung';
        $strings['UseSameLayoutForAllDays'] = 'Sử dụng cùng bố cục cho tất cả các ngày';
        $strings['LayoutVariesByDay'] = 'Bố cục thay đổi theo ngày';
        $strings['ManageReminders'] = 'Nhắc nhở';
        $strings['ReminderUser'] = 'ID người dùng';
        $strings['ReminderMessage'] = 'Nội dung';
        $strings['ReminderAddress'] = 'Địa chỉ';
        $strings['ReminderSendtime'] = 'Thời gian gửi';
        $strings['ReminderRefNumber'] = 'Mã tham chiếu đặt phòng';
        $strings['ReminderSendtimeDate'] = 'Ngày nhắc nhở';
        $strings['ReminderSendtimeTime'] = 'Giờ nhắc nhở (HH:MM)';
        $strings['ReminderSendtimeAMPM'] = 'SA / CH';
        $strings['AddReminder'] = 'Thêm nhắc nhở';
        $strings['DeleteReminderWarning'] = 'Bạn có chắc chắn muốn xóa mục này?';
        $strings['NoReminders'] = 'Bạn không có nhắc nhở sắp tới.';
        $strings['Reminders'] = 'Nhắc nhở';
        $strings['SendReminder'] = 'Gửi nhắc nhở';
        $strings['minutes'] = 'Phút';
        $strings['hours'] = 'Giờ';
        $strings['days'] = 'Ngày';
        $strings['ReminderBeforeStart'] = 'Trước khi cuộc họp bắt đầu';
        $strings['ReminderBeforeEnd'] = 'Trước khi cuộc họp kết thúc';
        $strings['Logo'] = 'Logo';
        $strings['CssFile'] = 'File CSS';
        $strings['ThemeUploadSuccess'] = 'Thay đổi của bạn đã được lưu. Tải lại trang để cập nhật.';
        $strings['MakeDefaultSchedule'] = 'Đặt làm lịch mặc định';
        $strings['DefaultScheduleSet'] = 'Đây là lịch mặc định của bạn';
        $strings['FlipSchedule'] = 'Đảo bố cục lịch';
        $strings['Next'] = 'Tiếp theo';
        $strings['Success'] = 'Thành công';
        $strings['Participant'] = 'Người tham dự';
        $strings['ResourceFilter'] = 'Lọc phòng chức năng';
        $strings['ResourceGroups'] = 'Nhóm phòng chức năng';
        $strings['AddNewGroup'] = 'Tạo nhóm mới';
        $strings['Quit'] = 'Thoát';
        $strings['AddGroup'] = 'Thêm Nhóm';
        $strings['StandardScheduleDisplay'] = 'Hiển thị lịch tiêu chuẩn';
        $strings['TallScheduleDisplay'] = 'Hiển thị lịch chi tiết';
        $strings['WideScheduleDisplay'] = 'Hiển thị lịch rộng';
        $strings['CondensedWeekScheduleDisplay'] = 'Hiển thị lịch tuần gọn';
        $strings['ResourceGroupHelp1'] = 'Kéo và thả các nhóm phòng chức năng để sắp xếp lại.';
        $strings['ResourceGroupHelp2'] = 'Nhấp chuột phải vào tên nhóm phòng chức năng để xem thêm các tùy chọn.';
        $strings['ResourceGroupHelp3'] = 'Kéo và thả phòng chức năng để thêm chúng vào nhóm.';
        $strings['ResourceGroupWarning'] = 'Nếu sử dụng nhóm phòng chức năng, mỗi phòng chức năng phải được gán vào ít nhất một nhóm. phòng chức năng không được gán sẽ không thể đặt chỗ.';
        $strings['ResourceType'] = 'Loại phòng chức năng';
        $strings['AppliesTo'] = 'Áp dụng cho';
        $strings['UniquePerInstance'] = 'Du nhất cho mỗi đặt phòng';
        $strings['AddResourceType'] = 'Thêm loại phòng chức năng';
        $strings['NoResourceTypeLabel'] = '(chưa thiết lập loại phòng chức năng)';
        $strings['ClearFilter'] = 'Xóa tìm kiếm';
        $strings['MinimumCapacity'] = 'Sức chứa tối thiểu';
        $strings['Color'] = 'Màu';
        $strings['Available'] = 'Sẵn sàng';
        $strings['Unavailable'] = 'Không có sẵn';
        $strings['Hidden'] = 'Ẩn';
        $strings['ResourceStatus'] = 'Trạng thái phòng chức năng';
        $strings['CurrentStatus'] = 'Trạng thái hiện tại';
        $strings['AllReservationResources'] = 'Tất cả phòng chức năng đặt chỗ';
        $strings['File'] = 'Tệp';
        $strings['BulkResourceUpdate'] = 'Cập nhật hàng loạt phòng chức năng';
        $strings['Unchanged'] = 'Không thay đổi';
        $strings['Common'] = 'Chung';
        $strings['AdminOnly'] = 'Chỉ dành cho Quản trị viên';
        $strings['AdvancedFilter'] = 'Bộ lọc nâng cao';
        $strings['MinimumQuantity'] = 'Số lượng tối thiểu';
        $strings['MaximumQuantity'] = 'Số lượng tối đa';
        $strings['ChangeLanguage'] = 'Thay đổi ngôn ngữ';
        $strings['AddRule'] = 'Thêm quy tắc';
        $strings['Attribute'] = 'Thuộc tính';
        $strings['RequiredValue'] = 'Giá trị bắt buộc';
        $strings['ReservationCustomRuleAdd'] = 'Nếu %s thì màu đặt phòng sẽ là';
        $strings['AddReservationColorRule'] = 'Thêm quy tắc màu đặt phòng';
        $strings['LimitAttributeScope'] = 'Thu thập trong các trường hợp cụ thể';
        $strings['CollectFor'] = 'Thu thập cho';
        $strings['SignIn'] = 'Đăng nhập';
        $strings['AllParticipants'] = 'Tất cả người tham dự';
        $strings['RegisterANewAccount'] = 'Đăng ký tài khoản mới';
        $strings['Dates'] = 'Ngày';
        $strings['More'] = 'Xem thêm';
        $strings['ResourceAvailability'] = 'Tính trạng phòng chức năng';
        $strings['UnavailableAllDay'] = 'Phòng chức năng bận cả ngày:';
        $strings['AvailableUntil'] = 'Có sẵn đến';
        $strings['AvailableBeginningAt'] = 'Bắt đầu từ';
        $strings['AvailableAt'] = 'Có sẵn tại';
        $strings['AllResourceTypes'] = 'Tất cả loại phòng chức năng';
        $strings['AllResourceStatuses'] = 'Tất cả trạng thái phòng chức năng';
        $strings['AllowParticipantsToJoin'] = 'Cho phép người tham dự tham gia';
        $strings['Join'] = 'Tham gia';
        $strings['YouAreAParticipant'] = 'Bạn là người tham dự cuộc họp này';
        $strings['YouAreInvited'] = 'Bạn được mời tham dự cuộc họp này';
        $strings['YouCanJoinThisReservation'] = 'Bạn có thể tham gia cuộc họp này';
        $strings['Import'] = 'Nhập tệp';
        $strings['GetTemplate'] = 'Lấy mẫu';
        $strings['UserImportInstructions'] = 'File phải ở định dạng CSV. Tên người dùng và email là các trường bắt buộc. Để trống các trường khác sẽ đặt các giá trị mặc định và "password" làm mật khẩu của người dùng. Sử dụng mẫu được cung cấp làm ví dụ.';
        $strings['RowsImported'] = 'Số dòng được nhập';
        $strings['RowsSkipped'] = 'Số dòng bị bỏ qua';
        $strings['Columns'] = 'Các cột';
        $strings['Reserve'] = 'Đặt phòng';
        $strings['AllDay'] = 'Cả Ngày';
        $strings['Everyday'] = 'Hàng ngày';
        $strings['IncludingCompletedReservations'] = 'Bao gồm các cuộc họp đã hoàn thành';
        $strings['NotCountingCompletedReservations'] = 'Không bao gồm các cuộc họp đã hoàn thành';
        $strings['RetrySkipConflicts'] = 'Bỏ qua các cuộc họp xung đột';
        $strings['Retry'] = 'Thử lại';
        $strings['RemoveExistingPermissions'] = 'Xóa quyền hiện có?';
        $strings['Continue'] = 'Tiếp tục';
        $strings['WeNeedYourEmailAddress'] = 'Chúng tôi cần địa chỉ email của bạn để đặt phòng';
        $strings['ResourceColor'] = 'Màu sắc phòng';
        $strings['DateTime'] = 'Ngày giờ';
        $strings['AutoReleaseNotification'] = 'Tự động giải phóng nếu không xác nhận trong vòng %s phút';
        $strings['RequiresCheckInNotification'] = 'Yêu cầu nhận/trả phòng';
        $strings['NoCheckInRequiredNotification'] = 'Không yêu cầu nhận/trả phòng';
        $strings['RequiresApproval'] = 'Yêu cầu phê duyệt';
        $strings['CheckingIn'] = 'Đang nhận phòng';
        $strings['CheckingOut'] = 'Đang trả phòng';
        $strings['CheckIn'] = 'Nhận phòng';
        $strings['CheckOut'] = 'Trả phòng';
        $strings['ReleasedIn'] = 'Được giải phóng trong';
        $strings['CheckedInSuccess'] = 'Bạn đã nhận phòng thành công';
        $strings['CheckedOutSuccess'] = 'Bạn đã trả phòng thành công';
        $strings['CheckInFailed'] = 'Bạn không thể nhận phòng';
        $strings['CheckOutFailed'] = 'Bạn không thể trả phòng';
        $strings['CheckInTime'] = 'Thời gian nhận phòng';
        $strings['CheckOutTime'] = 'Thời gian trả phòng';
        $strings['OriginalEndDate'] = 'Giờ kết thúc ban đầu';
        $strings['SpecificDates'] = 'Hiển thị ngày cụ thể';
        $strings['Users'] = 'Người dùng';
        $strings['Guest'] = 'Khách mời';
        $strings['ResourceDisplayPrompt'] = 'Hiển thị phòng chức năng';
        $strings['Credits'] = 'Điểm tín dụng';
        $strings['AvailableCredits'] = 'Số điểm tín dụng khả dụng';
        $strings['CreditUsagePerSlot'] = 'Yêu cầu %s điểm tín dụng mỗi khung giờ (ngoài giờ cao điểm)';
        $strings['PeakCreditUsagePerSlot'] = 'Yêu cầu %s điểm tín dụng mỗi khung giờ (giờ cao điểm)';
        $strings['CreditsRule'] = 'Bạn không đủ điểm tín dụng. Số điểm cần thiết: %s. Số điểm hiện có: %s';
        $strings['PeakTimes'] = 'Giờ cao điểm';
        $strings['AllYear'] = 'Cả năm';
        $strings['MoreOptions'] = 'Xem thêm tùy chọn';
        $strings['SendAsEmail'] = 'Gửi qua Email';
        $strings['UsersInGroups'] = 'Người dùng trong nhóm';
        $strings['UsersWithAccessToResources'] = 'Người dùng có quyền truy cập phòng chức năng';
        $strings['AnnouncementSubject'] = '%s đã đăng thông báo mới';
        $strings['AnnouncementEmailNotice'] = 'người dùng sẽ nhận thông báo này qua email';
        $strings['Day'] = 'Ngày';
        $strings['NotifyWhenAvailable'] = 'Thông báo khi có sẵn';
        $strings['AddingToWaitlist'] = 'Thêm bạn vào danh sách chờ';
        $strings['WaitlistRequestAdded'] = 'Bạn sẽ nhận được thông báo nếu khung giờ này có sẵn';
        $strings['PrintQRCode'] = 'In mã QR';
        $strings['FindATime'] = 'Tìm thời gian';
        $strings['AnyResource'] = 'Bất kỳ phòng chức năng nào';
        $strings['ThisWeek'] = 'Tuần này';
        $strings['Hours'] = 'Giờ';
        $strings['Minutes'] = 'Phút';
        $strings['ImportICS'] = 'Nhập từ ICS';
        $strings['ImportQuartzy'] = 'Nhập từ Quartzy';
        $strings['OnlyIcs'] = 'Chỉ có thể tải lên các file *.ics.';
        $strings['IcsLocationsAsResources'] = 'Địa điểm sẽ được nhập khẩu thành phòng chức năng.';
        $strings['IcsMissingOrganizer'] = 'Bất kỳ sự kiện nào thiếu người tổ chức sẽ được gán chủ sở hữu cho người dùng hiện tại.';
        $strings['IcsWarning'] = 'Quy tắc đặt phòng sẽ không được áp dụng - có thể xảy ra xung đột, trùng lặp, v.v.';
        $strings['BlackoutAroundConflicts'] = 'Chặn xung quanh các cuộc họp xung đột';
        $strings['DuplicateReservation'] = 'Tạo bản sao tương tự';
        $strings['UnavailableNow'] = 'Không có sẵn';
        $strings['ReserveLater'] = 'Đặt sau';
        $strings['CollectedFor'] = 'Thu thập cho';
        $strings['IncludeDeleted'] = 'Bao gồm các cuộc họp đã xóa';
        $strings['Deleted'] = 'Đã xóa';
        //
        $strings['Back'] = 'Quay lại';
        $strings['Forward'] = 'Tiến lên';
        $strings['DateRange'] = 'Khoảng thời gian';
        $strings['Copy'] = 'Sao chép';
        $strings['Detect'] = 'Phát hiện';
        $strings['Autofill'] = 'Tự động điền';
        $strings['NameOrEmail'] = 'Tên hoặc email';
        $strings['ImportResources'] = 'Nhập phòng chức năng';
        $strings['ExportResources'] = 'Xuất phòng chức năng';
        $strings['ResourceImportInstructions'] = '<ul><li>File phải ở định dạng CSV với mã hóa UTF-8.</li><li>Tên là trường bắt buộc. Để trống các trường khác sẽ đặt giá trị mặc định.</li><li>Các tùy chọn trạng thái là "Có sẵn", "Không có sẵn" và "Ẩn".</li><li>Màu sắc phải là giá trị hex. ví dụ) #ffffff.</li><li>Các cột tự động gán và phê duyệt có thể là đúng hoặc sai.</li><li>Tính hợp lệ của thuộc tính sẽ không được áp dụng.</li><li>Ngăn cách các nhóm phòng chức năng bằng dấu phẩy.</li><li>Thời gian có thể được chỉ định theo định dạng #ngày #giờ #phút hoặc HH:mm (1d3h30m hoặc 27:30 cho 1 ngày, 3 giờ, 30 phút)</li><li>Sử dụng mẫu được cung cấp làm ví dụ.</li></ul>';
        $strings['ReservationImportInstructions'] = '<ul><li>File phải ở định dạng CSV với mã hóa UTF-8.</li><li>Email, tên phòng chức năng, bắt đầu và kết thúc là các trường bắt buộc.</li><li>Bắt đầu và kết thúc yêu cầu ngày giờ đầy đủ. Định dạng được đề xuất là YYYY-mm-dd HH:mm (2017-12-31 20:30).</li><li>Quy tắc, xung đột và khung thời gian hợp lệ sẽ không được kiểm tra.</li><li>Thông báo sẽ không được gửi.</li><li>Tính hợp lệ của thuộc tính sẽ không được áp dụng.</li><li>Ngăn cách các tên phòng chức năng bằng dấu phẩy.</li><li>Sử dụng mẫu được cung cấp làm ví dụ.</li></ul>';
        $strings['AutoReleaseMinutes'] = 'Phút tự động giải phóng';
        $strings['CreditsPeak'] = 'Điểm tín dụng (giờ cao điểm)';
        $strings['CreditsOffPeak'] = 'Điểm tín dụng (ngoài giờ cao điểm)';
        $strings['ResourceMinLengthCsv'] = 'Thời gian đặt phòng tối thiểu';
        $strings['ResourceMaxLengthCsv'] = 'Thời gian đặt phòng tối đa';
        $strings['ResourceBufferTimeCsv'] = 'Thời gian đệm';
        $strings['ResourceMinNoticeAddCsv'] = 'Thời gian thông báo tối thiểu khi thêm đặt phòng';
        $strings['ResourceMinNoticeUpdateCsv'] = 'Thời gian thông báo tối thiểu khi cập nhật đặt phòng';
        $strings['ResourceMinNoticeNoneUpdate'] = 'Đặt phòng có thể được cập nhật cho đến thời điểm hiện tại';
        $strings['ResourceMinNoticeDeleteCsv'] = 'Thời gian thông báo tối thiểu khi xóa đặt phòng';
        $strings['ResourceMaxNoticeCsv'] = 'Thời gian kết thúc tối đa của đặt phòng';
        $strings['Export'] = 'Xuất';
        $strings['DeleteMultipleUserWarning'] = 'Xóa những người dùng này sẽ xóa tất cả các đặt phòng hiện tại, tương lai và lịch sử của họ. Không có email nào được gửi.';
        $strings['DeleteMultipleReservationsWarning'] = 'Không có email nào được gửi.';
        $strings['ErrorMovingReservation'] = 'Lỗi khi thay đổi đặt phòng';
        $strings['SelectUser'] = 'Chọn người dùng';
        $strings['InviteUsers'] = 'Mời người dùng';
        $strings['InviteUsersLabel'] = 'Nhập địa chỉ email của những người cần mời';
        $strings['ApplyToCurrentUsers'] = 'Áp dụng cho người dùng hiện tại';
        $strings['ReasonText'] = 'Lý do';
        $strings['NoAvailableMatchingTimes'] = 'Không tìm thấy thời gian phù hợp với tìm kiếm của bạn';
        $strings['Schedules'] = 'Lịch trình';
        $strings['NotifyUser'] = 'Thông báo cho người dùng';
        $strings['UpdateUsersOnImport'] = 'Cập nhật người dùng hiện có nếu email đã tồn tại';
        $strings['UpdateResourcesOnImport'] = 'Cập nhật phòng chức năng hiện có nếu tên đã tồn tại';
        $strings['Reject'] = 'Từ chối';
        $strings['CheckingAvailability'] = 'Đang kiểm tra tính khả dụng';
        $strings['CreditPurchaseNotEnabled'] = 'Bạn chưa bật tính năng mua điểm tín dụng';
        $strings['CreditsEachCost1'] = 'Mỗi';
        $strings['CreditsEachCost2'] = 'điểm tín dụng có giá';
        $strings['CreditsCount'] = 'Số lượng điểm tín dụng';
        $strings['CreditsCost'] = 'Tổng chi phí';
        $strings['Currency'] = 'Tiền tệ';
        $strings['PayPalClientId'] = 'Mã khách hàng';
        $strings['PayPalSecret'] = 'Mã bí mật';
        $strings['PayPalEnvironment'] = 'Môi trường';
        $strings['Sandbox'] = 'Môi trường thử nghiệm';
        $strings['Live'] = 'Môi trường thực';
        $strings['StripePublishableKey'] = 'Khóa công khai';
        $strings['StripeSecretKey'] = 'Khóa bí mật';
        $strings['CreditsUpdated'] = 'Giá điểm tín dụng đã được cập nhật';
        $strings['GatewaysUpdated'] = 'Cổng thanh toán đã được cập nhật';
        $strings['PurchaseSummary'] = 'Tóm tắt đơn hàng';
        $strings['EachCreditCosts'] = 'Mỗi điểm tín dụng có giá';
        $strings['Checkout'] = 'Thanh toán';
        $strings['Quantity'] = 'Số lượng';
        $strings['CreditPurchase'] = 'Mua điểm tín dụng';
        $strings['EmptyCart'] = 'Giỏ hàng của bạn trống.';
        $strings['BuyCredits'] = 'Mua điểm tín dụng';
        $strings['CreditsPurchased'] = 'điểm tín dụng đã được mua.';
        $strings['ViewYourCredits'] = 'Xem điểm tín dụng của bạn';
        $strings['TryAgain'] = 'Thử lại';
        $strings['PurchaseFailed'] = 'Chúng tôi gặp sự cố khi xử lý thanh toán của bạn.';
        $strings['NoteCreditsPurchased'] = 'Điểm tín dụng đã mua';
        $strings['CreditsUpdatedLog'] = 'Điểm tín dụng được cập nhật bởi %s';
        $strings['ReservationCreatedLog'] = 'Đặt phòng đã được tạo. Mã tham chiếu %s';
        $strings['ReservationUpdatedLog'] = 'Đặt phòng đã được cập nhật. Mã tham chiếu %s';
        $strings['ReservationDeletedLog'] = 'Đặt phòng đã bị xóa. Mã tham chiếu %s';
        $strings['BuyMoreCredits'] = 'Mua thêm điểm tín dụng';
        $strings['Transactions'] = 'Giao dịch';
        $strings['Cost'] = 'Tổng chi phí';
        $strings['PaymentGateways'] = 'Cổng thanh toán';
        $strings['CreditHistory'] = 'Lịch sử điểm tín dụng';
        $strings['TransactionHistory'] = 'Lịch sử giao dịch';
        $strings['Date'] = 'Ngày';
        $strings['Note'] = 'Ghi chú';
        $strings['CreditsBefore'] = 'Điểm tín dụng trước';
        $strings['CreditsAfter'] = 'Điểm tín dụng sau';
        $strings['TransactionFee'] = 'Phí giao dịch';
        $strings['InvoiceNumber'] = 'Số hóa đơn';
        $strings['TransactionId'] = 'Mã giao dịch';
        $strings['Gateway'] = 'Cổng thanh toán';
        $strings['GatewayTransactionDate'] = 'Ngày giao dịch trên cổng thanh toán';
        $strings['Refund'] = 'Hoàn tiền';
        $strings['IssueRefund'] = 'Hoàn tiền';
        $strings['RefundIssued'] = 'Hoàn tiền thành công';
        $strings['RefundAmount'] = 'Số tiền hoàn tiền';
        $strings['AmountRefunded'] = 'Đã hoàn tiền';
        $strings['FullyRefunded'] = 'Đã hoàn tiền đầy đủ';
        $strings['YourCredits'] = 'Điểm tín dụng của bạn';
        $strings['PayWithCard'] = 'Thanh toán bằng thẻ';
        $strings['or'] = 'hoặc';
        $strings['CreditsRequired'] = 'Số điểm tín dụng cần thiết';
        $strings['AddToGoogleCalendar'] = 'Thêm vào Google Lịch';
        $strings['Image'] = 'Hình ảnh';
        $strings['ChooseOrDropFile'] = 'Chọn tệp hoặc kéo thả vào đây';
        $strings['SlackBookResource'] = 'Đặt phòng %s ngay bây giờ';
        $strings['SlackBookNow'] = 'Đặt phòng ngay';
        $strings['SlackNotFound'] = 'Không tìm thấy phòng chức năng với tên đó. Đặt phòng ngay để tạo đặt phòng mới.';
        $strings['AutomaticallyAddToGroup'] = 'Tự động thêm người dùng mới vào nhóm này';
        $strings['GroupAutomaticallyAdd'] = 'Tự động thêm';
        $strings['TermsOfService'] = 'Điều khoản dịch vụ';
        $strings['EnterTermsManually'] = 'Nhập Điều khoản bằng tay';
        $strings['LinkToTerms'] = 'Liên kết đến Điều khoản';
        $strings['UploadTerms'] = 'Tải lên Điều khoản';
        $strings['RequireTermsOfServiceAcknowledgement'] = 'Yêu cầu Xác nhận Điều khoản dịch vụ';
        $strings['UponReservation'] = 'Khi đặt phòng';
        $strings['UponRegistration'] = 'Khi đăng ký';
        $strings['ViewTerms'] = 'Xem Điều khoản dịch vụ';
        $strings['IAccept'] = 'Tôi đồng ý';
        $strings['TheTermsOfService'] = 'Điều khoản dịch vụ';
        $strings['DisplayPage'] = 'Hiển thị trang';
        $strings['AvailableAllYear'] = 'Cả năm';
        $strings['Availability'] = 'Tính khả dụng';
        $strings['AvailableBetween'] = 'Có sẵn trong khoảng';
        $strings['ConcurrentYes'] = 'Nhiều người có thể đặt phòng cùng một lúc';
        $strings['ConcurrentNo'] = 'Không thể có nhiều người đặt phòng cùng một lúc';
        $strings['ScheduleAvailabilityEarly'] = 'Lịch trình này hiện chưa khả dụng. Nó có sẵn từ';
        $strings['ScheduleAvailabilityLate'] = 'Lịch trình này không còn khả dụng. Nó đã có sẵn từ';
        $strings['ResourceImages'] = 'Hình ảnh phòng chức năng';
        $strings['FullAccess'] = 'Truy cập đầy đủ';
        $strings['ViewOnly'] = 'Chỉ xem';
        $strings['Purge'] = 'Xóa dữ liệu';
        $strings['UsersWillBeDeleted'] = '%s người dùng sẽ bị xóa';
        $strings['BlackoutsWillBeDeleted'] = 'Các khung thời gian bị chặn sẽ bị xóa';
        $strings['ReservationsWillBePurged'] = 'Đặt phòng sẽ bị xóa hoàn toàn';
        $strings['ReservationsWillBeDeleted'] = 'Đặt phòng sẽ bị xóa';
        $strings['PermanentlyDeleteUsers'] = 'Xóa vĩnh viễn người dùng chưa đăng nhập kể từ';
        $strings['DeleteBlackoutsBefore'] = 'Xóa các khung thời gian bị chặn trước';
        $strings['DeletedReservations'] = 'Đặt phòng đã xóa';
        $strings['DeleteReservationsBefore'] = 'Xóa đặt phòng trước';
        $strings['SwitchToACustomLayout'] = 'Chuyển sang bố cục tùy chỉnh';
        $strings['SwitchToAStandardLayout'] = 'Chuyển sang bố cục chuẩn';
        $strings['ThisScheduleUsesACustomLayout'] = 'Lịch trình này sử dụng bố cục tùy chỉnh';
        $strings['ThisScheduleUsesAStandardLayout'] = 'Lịch trình này sử dụng bố cục chuẩn';
        $strings['SwitchLayoutWarning'] = 'Bạn có chắc chắn muốn thay đổi loại bố cục? Điều này sẽ xóa tất cả các khung thời gian hiện có.';
        $strings['DeleteThisTimeSlot'] = 'Xóa khung thời gian này?';
        $strings['Refresh'] = 'Làm mới';
        $strings['ViewReservation'] = 'Xem đặt phòng';
        $strings['PublicId'] = 'ID công khai';
        $strings['Public'] = 'Công khai';
        $strings['AtomFeedTitle'] = 'Đặt phòng %s';
        $strings['DefaultStyle'] = 'Kiểu mặc định';
        $strings['Standard'] = 'Tiêu chuẩn';
        $strings['Wide'] = 'Rộng';
        $strings['Tall'] = 'Cao';
        $strings['EmailTemplate'] = 'Mẫu email';
        $strings['SelectEmailTemplate'] = 'Chọn mẫu email';
        $strings['ReloadOriginalContents'] = 'Tải lại nội dung gốc';
        $strings['UpdateEmailTemplateSuccess'] = 'Cập nhật mẫu email thành công';
        $strings['UpdateEmailTemplateFailure'] = 'Không thể cập nhật mẫu email. Kiểm tra xem thư mục có thể ghi được không.';
        $strings['BulkResourceDelete'] = 'Xóa phòng chức năng hàng loạt';
        $strings['NewVersion'] = 'Phiên bản mới!';
        $strings['WhatsNew'] = 'Có gì mới?';
        $strings['OnlyViewedCalendar'] = 'Chỉ có thể xem lịch trình này từ chế độ xem lịch';
        $strings['Grid'] = 'Lưới';
        $strings['List'] = 'Danh sách';
        $strings['NoReservationsFound'] = 'Không tìm thấy đặt phòng nào';
        $strings['Email Reservation'] = 'Gửi email đặt phòng';
        $strings['AdHocMeeting'] = 'Cuộc họp đột xuất';
        $strings['NextReservation'] = 'Đặt phòng sắp tới';
        $strings['MissedCheckin'] = 'Nhận phòng trễ';
        $strings['MissedCheckout'] = 'Trả phòng trễ';
        $strings['Utilization'] = 'Tỷ lệ sử dụng';
        $strings['SpecificTime'] = 'Thời gian cụ thể';
        $strings['ReservationSeriesEndingPreference'] = 'Khi chuỗi đặt phòng định kỳ của tôi kết thúc';
        $strings['NotAttending'] = 'Không tham dự';
        $strings['ViewAvailability'] = 'Xem tính khả dụng';
        $strings['ReservationDetails'] = 'Chi tiết đặt phòng';
        $strings['StartTime'] = 'Giờ bắt đầu';
        $strings['EndTime'] = 'Giờ kết thúc';
        $strings['New'] = 'Mới';
        $strings['Updated'] = 'Cập nhật';
        $strings['Custom'] = 'Tùy chỉnh';
        $strings['AddDate'] = 'Thêm ngày';
        $strings['RepeatOn'] = 'Lặp lại vào';
        $strings['ScheduleConcurrentMaximum'] = 'Tổng cộng có thể đặt phòng đồng thời <b>%s</b> phòng chức năng';
        $strings['ScheduleConcurrentMaximumNone'] = 'Không giới hạn số lượng phòng chức năng được đặt phòng đồng thời';
        $strings['ScheduleMaximumConcurrent'] = 'Số lượng phòng chức năng tối đa được đặt phòng đồng thời';
        $strings['ScheduleMaximumConcurrentNote'] = 'Khi được đặt, tổng số phòng chức năng có thể được đặt phòng đồng thời cho lịch trình này sẽ bị giới hạn.';
        $strings['ScheduleResourcesPerReservationMaximum'] = 'Mỗi đặt phòng được giới hạn tối đa <b>%s</b> phòng chức năng';
        $strings['ScheduleResourcesPerReservationNone'] = 'Không giới hạn số lượng phòng chức năng cho mỗi đặt phòng';
        $strings['ScheduleResourcesPerReservation'] = 'Số lượng phòng chức năng tối đa cho mỗi đặt phòng';
        $strings['ResourceConcurrentReservations'] = 'Cho phép đặt phòng đồng thời %s';
        $strings['ResourceConcurrentReservationsNone'] = 'Không cho phép đặt phòng đồng thời';
        $strings['AllowConcurrentReservations'] = 'Cho phép đặt phòng đồng thời';
        $strings['ResourceDisplayInstructions'] = 'Chưa chọn phòng chức năng nào. Bạn có thể tìm URL để hiển thị phòng chức năng trong Quản lý ứng dụng, phòng chức năng. phòng chức năng phải truy cập được công khai.';
        $strings['Owner'] = 'Chủ sở hữu';
        $strings['MaximumConcurrentReservations'] = 'Số lượng đặt phòng đồng thời tối đa';
        $strings['Notify Users'] = 'Thông báo cho người dùng';
        $strings['Message'] = 'Tin nhắn';
        $strings['AllUsersWhoHaveAReservationInTheNext'] = 'Bất kỳ ai có đặt phòng trong';
        $strings['ChangeResourceStatus'] = 'Thay đổi trạng thái phòng chức năng';
        $strings['UpdateGroupsOnImport'] = 'Cập nhật nhóm hiện có nếu tên trùng khớp';
        $strings['GroupsImportInstructions'] = '<ul><li>File phải ở định dạng CSV.</li><li>Tên là bắt buộc.</li><li>Danh sách thành viên nên là danh sách email được phân cách bằng dấu phẩy.</li><li>Danh sách thành viên trống khi cập nhật nhóm sẽ giữ nguyên thành viên.</li><li>Danh sách quyền nên là danh sách tên phòng chức năng được phân cách bằng dấu phẩy.</li><li>Danh sách quyền trống khi cập nhật nhóm sẽ giữ nguyên quyền.</li><li>Sử dụng mẫu được cung cấp làm ví dụ.</li></ul>';
        $strings['PhoneRequired'] = 'Số điện thoại là bắt buộc';
        $strings['OrganizationRequired'] = 'Tên tổ chức là bắt buộc';
        $strings['PositionRequired'] = 'Chức vụ là bắt buộc';
        $strings['GroupMembership'] = 'Thành viên nhóm';
        $strings['AvailableGroups'] = 'Các nhóm khả dụng';
        $strings['CheckingAvailabilityError'] = 'Không thể lấy tính khả dụng của phòng chức năng - quá nhiều phòng chức năng';
        // End Strings

        // Install
        $strings['InstallApplication'] = 'Cài đặt LibreBooking (chỉ MySQL)';
        $strings['IncorrectInstallPassword'] = 'Xin lỗi, mật khẩu đó không đúng.';
        $strings['SetInstallPassword'] = 'Bạn phải đặt mật khẩu cài đặt trước khi quá trình cài đặt có thể chạy.';
        $strings['InstallPasswordInstructions'] = 'Trong %s vui lòng đặt %s thành mật khẩu ngẫu nhiên và khó đoán, sau đó quay lại trang này.<br/>Bạn có thể sử dụng %s';
        $strings['NoUpgradeNeeded'] = 'LibreBooking đã được cập nhật. Không cần nâng cấp.';
        $strings['ProvideInstallPassword'] = 'Vui lòng cung cấp mật khẩu cài đặt của bạn.';
        $strings['InstallPasswordLocation'] = 'Điều này có thể được tìm thấy tại %s trong %s.';
        $strings['VerifyInstallSettings'] = 'Xác minh các cài đặt mặc định sau trước khi tiếp tục. Hoặc bạn có thể thay đổi chúng trong %s.';
        $strings['DatabaseName'] = 'Tên cơ sở dữ liệu';
        $strings['DatabaseUser'] = 'Người dùng cơ sở dữ liệu';
        $strings['DatabaseHost'] = 'Máy chủ cơ sở dữ liệu';
        $strings['DatabaseCredentials'] = 'Bạn phải cung cấp thông tin xác thực của người dùng MySQL có quyền tạo cơ sở dữ liệu. Nếu bạn không biết, hãy liên hệ với quản trị viên cơ sở dữ liệu của bạn. Trong nhiều trường hợp, root sẽ hoạt động.';
        $strings['MySQLUser'] = 'Người dùng MySQL';
        $strings['InstallOptionsWarning'] = 'Các tùy chọn sau có thể không hoạt động trong môi trường được lưu trữ. Nếu bạn đang cài đặt trong môi trường được lưu trữ, hãy sử dụng các công cụ hướng dẫn MySQL để hoàn thành các bước này.';
        $strings['CreateDatabase'] = 'Tạo cơ sở dữ liệu';
        $strings['CreateDatabaseUser'] = 'Tạo người dùng cơ sở dữ liệu';
        $strings['PopulateExampleData'] = 'Nhập dữ liệu mẫu. Tạo tài khoản quản trị viên: admin/password và tài khoản người dùng: user/password';
        $strings['DataWipeWarning'] = 'Cảnh báo: Điều này sẽ xóa mọi dữ liệu hiện có';
        $strings['RunInstallation'] = 'Chạy cài đặt';
        $strings['UpgradeNotice'] = 'Bạn đang nâng cấp từ phiên bản <b>%s</b> lên phiên bản <b>%s</b>';
        $strings['RunUpgrade'] = 'Chạy nâng cấp';
        $strings['Executing'] = 'Đang thực hiện';
        $strings['StatementFailed'] = 'Thất bại. Chi tiết:';
        $strings['SQLStatement'] = 'Câu lệnh SQL:';
        $strings['ErrorCode'] = 'Mã lỗi:';
        $strings['ErrorText'] = 'Văn bản lỗi:';
        $strings['InstallationSuccess'] = 'Cài đặt hoàn tất thành công!';
        $strings['RegisterAdminUser'] = 'Đăng ký người dùng quản trị của bạn. Điều này là bắt buộc nếu bạn không nhập dữ liệu mẫu. Đảm bảo rằng $conf[\'settings\'][\'allow.self.registration\'] = \'true\' trong tệp %s của bạn.';
        $strings['LoginWithSampleAccounts'] = 'Nếu bạn đã nhập dữ liệu mẫu, bạn có thể đăng nhập bằng admin/password cho người dùng quản trị hoặc user/password cho người dùng cơ bản.';
        $strings['InstalledVersion'] = 'Bạn hiện đang chạy phiên bản %s của LibreBooking';
        $strings['InstallUpgradeConfig'] = 'Nên nâng cấp tệp cấu hình của bạn';
        $strings['InstallationFailure'] = 'Có vấn đề với cài đặt. Vui lòng sửa chữa chúng và thử lại quá trình cài đặt.';
        $strings['ConfigureApplication'] = 'Cấu hình LibreBooking';
        $strings['ConfigUpdateSuccess'] = 'Tệp cấu hình của bạn hiện đã được cập nhật!';
        $strings['ConfigUpdateFailure'] = 'Chúng tôi không thể tự động cập nhật tệp cấu hình của bạn. Vui lòng ghi đè nội dung của config.php bằng những điều sau:';
        $strings['SelectUser'] = 'Chọn người dùng';
        // End Install

        // Errors
        $strings['LoginError'] = 'Hệ thống không tìm thấy tên đăng nhập hoặc mật khẩu mà bạn vừa gõ';
        $strings['ReservationFailed'] = 'Đặt chỗ của bạn không thể thực hiện';
        $strings['MinNoticeError'] = 'Đặt chỗ này yêu cầu thông báo trước. Ngày và giờ sớm nhất có thể đặt là %s.';
        $strings['MinNoticeErrorUpdate'] = 'Việc thay đổi đặt chỗ này yêu cầu thông báo trước. Không được phép thay đổi đặt chỗ trước %s.';
        $strings['MinNoticeErrorDelete'] = 'Việc xóa đặt chỗ này yêu cầu thông báo trước. Không được phép xóa đặt chỗ trước %s.';
        $strings['MaxNoticeError'] = 'Đặt chỗ này không thể được thực hiện quá xa trong tương lai. Ngày và giờ muộn nhất có thể đặt là %s.';
        $strings['MinDurationError'] = 'Đặt chỗ này phải kéo dài ít nhất %s.';
        $strings['MaxDurationError'] = 'Đặt chỗ này không thể kéo dài hơn %s.';
        $strings['ConflictingAccessoryDates'] = 'Không đủ các phụ kiện sau:';
        $strings['NoResourcePermission'] = 'Bạn không có quyền truy cập vào một hoặc nhiều phòng chức năng yêu cầu.';
        $strings['ConflictingReservationDates'] = 'Có những đặt chỗ trùng lặp vào các ngày sau:';
        $strings['InstancesOverlapRule'] = 'Một số phiên bản trong chuỗi đặt chỗ này trùng lặp nhau:';
        $strings['StartDateBeforeEndDateRule'] = 'Ngày và giờ bắt đầu phải trước ngày và giờ kết thúc.';
        $strings['StartIsInPast'] = 'Ngày và giờ bắt đầu không thể là trong quá khứ.';
        $strings['EmailDisabled'] = 'Quản trị viên đã tắt thông báo email.';
        $strings['ValidLayoutRequired'] = 'Các khe thời gian phải được cung cấp cho cả 24 giờ trong ngày bắt đầu và kết thúc lúc 12:00 AM.';
        $strings['CustomAttributeErrors'] = 'Có vấn đề với các thuộc tính bổ sung mà bạn cung cấp:';
        $strings['CustomAttributeRequired'] = '%s là một trường bắt buộc.';
        $strings['CustomAttributeInvalid'] = 'Giá trị cung cấp cho %s không hợp lệ.';
        $strings['AttachmentLoadingError'] = 'Xin lỗi, đã xảy ra sự cố khi tải tệp yêu cầu.';
        $strings['InvalidAttachmentExtension'] = 'Bạn chỉ có thể tải lên các tệp có loại: %s';
        $strings['InvalidStartSlot'] = 'Ngày và giờ bắt đầu yêu cầu không hợp lệ.';
        $strings['InvalidEndSlot'] = 'Ngày và giờ kết thúc yêu cầu không hợp lệ.';
        $strings['MaxParticipantsError'] = '%s chỉ có thể hỗ trợ %s người tham gia.';
        $strings['ReservationCriticalError'] = 'Đã xảy ra lỗi nghiêm trọng khi lưu đặt chỗ của bạn. Nếu điều này tiếp tục, hãy liên hệ với quản trị viên hệ thống của bạn.';
        $strings['InvalidStartReminderTime'] = 'Thời gian nhắc nhở bắt đầu không hợp lệ.';
        $strings['InvalidEndReminderTime'] = 'Thời gian nhắc nhở kết thúc không hợp lệ.';
        $strings['QuotaExceeded'] = 'Đã vượt quá giới hạn hạn ngạch.';
        $strings['MultiDayRule'] = '%s không cho phép đặt chỗ qua nhiều ngày.';
        $strings['InvalidReservationData'] = 'Có vấn đề với yêu cầu đặt chỗ của bạn.';
        $strings['PasswordError'] = 'Mật khẩu phải chứa ít nhất %s chữ cái và ít nhất %s số.';
        $strings['PasswordErrorRequirements'] = 'Mật khẩu phải chứa sự kết hợp của ít nhất %s chữ cái viết hoa và viết thường và %s số.';
        $strings['NoReservationAccess'] = 'Bạn không được phép thay đổi đặt chỗ này.';
        $strings['PasswordControlledExternallyError'] = 'Mật khẩu của bạn được kiểm soát bởi một hệ thống bên ngoài và không thể cập nhật ở đây.';
        $strings['AccessoryResourceRequiredErrorMessage'] = 'Phụ kiện %s chỉ có thể được đặt cùng với các phòng chức năng %s';
        $strings['AccessoryMinQuantityErrorMessage'] = 'Bạn phải đặt ít nhất %s của phụ kiện %s';
        $strings['AccessoryMaxQuantityErrorMessage'] = 'Bạn không thể đặt nhiều hơn %s của phụ kiện %s';
        $strings['AccessoryResourceAssociationErrorMessage'] = 'Phụ kiện \'%s\' không thể được đặt cùng với các phòng chức năng yêu cầu';
        $strings['NoResources'] = 'Bạn chưa thêm bất kỳ phòng chức năng nào.';
        $strings['ParticipationNotAllowed'] = 'Bạn không được phép tham gia đặt chỗ này.';
        $strings['ReservationCannotBeCheckedInTo'] = 'Đặt chỗ này không thể được đăng ký.';
        $strings['ReservationCannotBeCheckedOutFrom'] = 'Đặt chỗ này không thể được thanh toán.';
        $strings['InvalidEmailDomain'] = 'Địa chỉ email đó không thuộc miền được phép';
        $strings['TermsOfServiceError'] = 'Bạn cần phải chấp nhận Điều khoản dịch vụ';
        $strings['UserNotFound'] = 'Không tìm thấy người dùng';
        $strings['ScheduleAvailabilityError'] = 'Lịch đặt chỗ này chỉ khả dụng từ %s đến %s';
        $strings['ReservationNotFoundError'] = 'Không tìm thấy đặt chỗ';
        $strings['ReservationNotAvailable'] = 'Đặt chỗ không khả dụng';
        $strings['TitleRequiredRule'] = 'Tiêu đề đặt chỗ là bắt buộc';
        $strings['DescriptionRequiredRule'] = 'Mô tả đặt chỗ là bắt buộc';
        $strings['WhatCanThisGroupManage'] = 'Nhóm này có thể quản lý những gì?';
        $strings['ReservationParticipationActivityPreference'] = 'Khi ai đó tham gia hoặc rời khỏi đặt chỗ của tôi';
        $strings['RegisteredAccountRequired'] = 'Chỉ người dùng đã đăng ký mới có thể đặt chỗ';
        $strings['InvalidNumberOfResourcesError'] = 'Số lượng phòng chức năng tối đa có thể đặt trong một lần đặt chỗ là %s';
        $strings['ScheduleTotalReservationsError'] = 'Lịch đặt chỗ này chỉ cho phép đặt tối đa %s phòng chức năng cùng một lúc. Đặt chỗ này sẽ vượt quá giới hạn đó vào các ngày sau:';
        // End Errors


        // Tiêu đề trang
        $strings['CreateReservation'] = 'Tạo đặt phòng';
        $strings['EditReservation'] = 'Chỉnh sửa đặt phòng';
        $strings['LogIn'] = 'Đăng nhập';
        $strings['ManageReservations'] = 'Duyệt thông tin tất cả phòng';
        $strings['AwaitingActivation'] = 'Chờ kích hoạt';
        $strings['PendingApproval'] = 'Chờ duyệt';
        $strings['ManageSchedules'] = 'Lịch trình';
        $strings['ManageResources'] = 'Phòng chức năng';
        $strings['ManageAccessories'] = 'Thiết bị / Phụ kiện';
        $strings['ManageUsers'] = 'Người dùng';
        $strings['ManageGroups'] = 'Nhóm';
        $strings['ManageQuotas'] = 'Hạn mức';
        $strings['ManageBlackouts'] = 'Thời gian bị chặn';
        $strings['MyDashboard'] = 'Bảng điều khiển của tôi';
        $strings['ServerSettings'] = 'Cài đặt máy chủ';
        $strings['Dashboard'] = 'Bảng điều khiển';
        $strings['Help'] = 'Trợ giúp';
        $strings['Administration'] = 'Quản trị';
        $strings['About'] = 'Giới thiệu';
        $strings['Bookings'] = 'Đặt chỗ';
        $strings['Schedule'] = 'Lịch trình';
        $strings['Account'] = 'Tài khoản';
        $strings['EditProfile'] = 'Chỉnh sửa hồ sơ';
        $strings['FindAnOpening'] = 'Tìm lịch trống';
        $strings['OpenInvitations'] = 'Lời mời tham gia';
        $strings['ResourceCalendar'] = 'Lịch các phòng chức năng';
        $strings['Reservation'] = 'Đặt phòng mới';
        $strings['Install'] = 'Cài đặt';
        $strings['ChangePassword'] = 'Đổi mật khẩu';
        $strings['MyAccount'] = 'Tài khoản của tôi';
        $strings['Profile'] = 'Hồ sơ';
        $strings['ApplicationManagement'] = 'Quản lý ứng dụng';
        $strings['ForgotPassword'] = 'Quên mật khẩu';
        $strings['NotificationPreferences'] = 'Cài đặt thông báo';
        $strings['ManageAnnouncements'] = 'Thông báo ứng dụng';
        $strings['Responsibilities'] = 'Quản lý';
        $strings['GroupReservations'] = 'Duyệt thông tin phòng theo nhóm';
        $strings['ResourceReservations'] = 'Duyệt thông tin phòng';
        $strings['Customization'] = 'Tùy chỉnh';
        $strings['Attributes'] = 'Thuộc tính';
        $strings['AccountActivation'] = 'Kích hoạt tài khoản';
        $strings['ScheduleReservations'] = 'Duyệt thông tin phòng theo lịch trình';
        $strings['Reports'] = 'Báo cáo';
        $strings['GenerateReport'] = 'Tạo báo cáo mới';
        $strings['MySavedReports'] = 'Báo cáo đã lưu của tôi';
        $strings['CommonReports'] = 'Báo cáo thường dùng';
        $strings['ViewDay'] = 'Xem theo ngày';
        $strings['Group'] = 'Nhóm';
        $strings['ManageConfiguration'] = 'Cấu hình ứng dụng';
        $strings['LookAndFeel'] = 'Giao diện';
        $strings['ManageResourceGroups'] = 'Nhóm phòng chức năng';
        $strings['ManageResourceTypes'] = 'Loại phòng chức năng';
        $strings['ManageResourceStatus'] = 'Trạng thái phòng chức năng';
        $strings['ReservationColors'] = 'Màu sắc đặt phòng';
        $strings['SearchReservations'] = 'Tìm kiếm đặt phòng';
        $strings['ManagePayments'] = 'Quản lý thanh toán';
        $strings['ViewCalendar'] = 'Xem lịch';
        $strings['DataCleanup'] = 'Dọn dẹp dữ liệu';
        $strings['ManageEmailTemplates'] = 'Quản lý mẫu email';
        $strings['CheckResources'] = 'Kiểm tra phòng chức năng';
        $strings['CheckSchedules'] = 'Kiểm tra lịch trình';
        // Kết thúc Tiêu đề trang



        // Day representations
        $strings['DaySundaySingle'] = 'S';
        $strings['DayMondaySingle'] = 'M';
        $strings['DayTuesdaySingle'] = 'T';
        $strings['DayWednesdaySingle'] = 'W';
        $strings['DayThursdaySingle'] = 'T';
        $strings['DayFridaySingle'] = 'F';
        $strings['DaySaturdaySingle'] = 'S';

        $strings['DaySundayAbbr'] = 'Chủ Nhật';
        $strings['DayMondayAbbr'] = 'Thứ 2';
        $strings['DayTuesdayAbbr'] = 'Thứ 3';
        $strings['DayWednesdayAbbr'] = 'Thứ 4';
        $strings['DayThursdayAbbr'] = 'Thứ 5';
        $strings['DayFridayAbbr'] = 'Thứ 6';
        $strings['DaySaturdayAbbr'] = 'Thứ 7';
        // End Day representations

        // Email Subjects
        $strings['ReservationApprovedSubject'] = 'phòng chức năng của bạn đã được phê duyệt';
        $strings['ReservationCreatedSubject'] = 'phòng chức năng của bạn đã được tạo';
        $strings['ReservationUpdatedSubject'] = 'phòng chức năng của bạn đã được cập nhật';
        $strings['ReservationDeletedSubject'] = 'phòng chức năng của bạn đã bị xóa';
        $strings['ReservationCreatedAdminSubject'] = 'Thông báo: phòng chức năng đã được tạo';
        $strings['ReservationUpdatedAdminSubject'] = 'Thông báo: phòng chức năng đã được cập nhật';
        $strings['ReservationDeleteAdminSubject'] = 'Thông báo: phòng chức năng đã bị xóa';
        $strings['ReservationApprovalAdminSubject'] = 'Thông báo: Yêu cầu đặt phòng chức năng của bạn phải được phê duyệt';
        $strings['ParticipantAddedSubject'] = 'Thông báo tham dự họp';
        $strings['ParticipantDeletedSubject'] = 'phòng chức năng đã hủy';
        $strings['InviteeAddedSubject'] = 'Mời người tham dự họp';
        $strings['ResetPasswordRequest'] = 'Yêu cầu đổi mật khẩu';
        $strings['ActivateYourAccount'] = 'Vui lòng kích hoạt tài khoản của bạn';
        $strings['ReportSubject'] = 'Báo cáo được yêu cầu của bạn (%s)';
        $strings['ReservationStartingSoonSubject'] = 'phòng chức năng %s sắp bắt đầu';
        $strings['ReservationEndingSoonSubject'] = 'phòng chức năng %s sắp kết thúc';
        $strings['UserAdded'] = 'Người dùng mới đã được tạo';
        $strings['UserDeleted'] = 'Tài khoản người dùng %s đã bị xóa bởi %s';
        $strings['GuestAccountCreatedSubject'] = 'Thông tin tài khoản của bạn';
        // End Email Subjects

        //NEEDS CHECKING
        //Lịch sử đặt phòng
        $strings['NoPastReservations'] = 'Bạn không có lịch sử đặt phòng nào';
        $strings['PastReservations'] = 'Lịch sử đặt phòng';
        $strings['AllNoPastReservations'] = 'Không có đặt phòng nào trong %s ngày qua';
        $strings['AllPastReservations'] = 'Tất cả lịch sử đặt phòng';
        $strings['Yesterday'] = 'Hôm qua';
        $strings['EarlierThisWeek'] = 'Đầu tuần này';
        $strings['PreviousWeek'] = 'Tuần trước';
        //Kết thúc Lịch sử đặt phòng

        //Lịch sử đặt phòng của Nhóm
        $strings['GroupUpcomingReservations'] = 'Lịch sử đặt phòng sắp tới của Nhóm của tôi';
        $strings['NoGroupUpcomingReservations'] = 'Nhóm của bạn không có đặt phòng sắp tới';
        //Kết thúc Lịch sử đặt phòng của Nhóm

        //Lỗi đăng nhập Facebook SDK
        $strings['FacebookLoginErrorMessage'] = 'Đã xảy ra lỗi khi đăng nhập bằng Facebook. Vui lòng thử lại.';
        //Kết thúc Lỗi đăng nhập Facebook SDK

        //Lịch sử đặt phòng chờ duyệt
        $strings['NoPendingApprovalReservations'] = 'Bạn không có đặt phòng nào đang chờ duyệt';
        $strings['PendingApprovalReservations'] = 'Lịch sử đặt phòng chờ duyệt';
        $strings['LaterThisMonth'] = 'Cuối tháng này';
        $strings['LaterThisYear'] = 'Cuối năm nay';
        $strings['Other'] = 'Khác';
        //Kết thúc Lịch sử đặt phòng chờ duyệt

        //Lịch sử đặt phòng thiếu Check In/Out
        $strings['NoMissingCheckOutReservations'] = 'Không có đặt phòng nào thiếu trả phòng';
        $strings['MissingCheckOutReservations'] = 'Đặt phòng thiếu trả phòng';

        //Kết thúc Lịch sử đặt phòng thiếu Check In/Out

        //Quyền truy cập phòng chức năng
        $strings['NoResourcePermissions'] = 'Không thể xem chi tiết đặt phòng vì bạn không có quyền truy cập vào bất kỳ nguồn phòng chức năng nào trong đặt phòng này';
        //Kết thúc Quyền truy cập phòng chức năng

        //Xem phòng chức năng
        $strings['Check'] = 'Kiểm tra';
        $strings['PermissionType'] = 'Loại quyền';
        $strings['NoResourcesToView'] = 'Không có phòng chức năng nào khả dụng';
        //Kết thúc Xem phòng chức năng

        //END NEEDS CHECKING


        $this->Strings = $strings;

        return $this->Strings;
    }

    /**
     * @return array
     */
    protected function _LoadDays()
    {
        $days = [];

        /***
         * DAY NAMES
         * All of these arrays MUST start with Sunday as the first element
         * and go through the seven day week, ending on Saturday
         ***/
        // The full day name
        $days['full'] = ['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        // The three letter abbreviation
        $days['abbr'] = ['CN', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        // The two letter abbreviation
        $days['two'] = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
        // The one letter abbreviation
        $days['letter'] = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];

        $this->Days = $days;

        return $this->Days;
    }

    /**
     * @return array
     */
    protected function _LoadMonths()
    {
        $months = [];

        /***
         * MONTH NAMES
         * All of these arrays MUST start with January as the first element
         * and go through the twelve months of the year, ending on December
         ***/
        // The full month name
        $months['full'] = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        // The three letter month name
        $months['abbr'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $this->Months = $months;

        return $this->Months;
    }

    /**
     * @return array
     */
    protected function _LoadLetters()
    {
        $this->Letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        return $this->Letters;
    }

    protected function _GetHtmlLangCode()
    {
        return 'vn_vn';
    }
}

