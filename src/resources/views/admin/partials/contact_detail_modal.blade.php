<div id='contactDetailModal' class='admin-modal'>
    <div class='admin-modal__content'>
        <button type='button' class='admin-modal__close-button js-close-modal'>&times;</button>
        <div class='admin-modal__body'>
            <dl class='admin-modal__detail-list'>
                <dt>お名前</dt><dd id='modalContactName'></dd>
                <dt>性別</dt><dd id='modalContactGender'></dd>
                <dt>メールアドレス</dt><dd id='modalContactEmail'></dd>
                <dt>電話番号</dt><dd id='modalContactTel'></dd>
                <dt>住所</dt><dd id='modalContactAddress'></dd>
                <dt>建物名</dt><dd id='modalContactBuilding'></dd>
                <dt>お問い合わせの種類</dt><dd id='modalContactCategory'></dd>
                <dt>お問い合わせ内容</dt><dd id='modalContactDetail'></dd>
            </dl>
        </div>
        <div class='admin-modal__footer'>
            <form id='deleteContactForm' method='post' action=''>
                @csrf
                @method('DELETE')
                <button type='submit' class='admin-modal__button admin-modal__button--delete'>削除</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('contactDetailModal');
    const openModalButtons = document.querySelectorAll('.js-open-modal');
    const closeModalButtons = document.querySelectorAll('.js-close-modal');
    const deleteForm = document.getElementById('deleteContactForm');

    if (!modal) {
        return;
    }

    /* モーダルウィンドウを開く */
    openModalButtons.forEach((button) => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('modalContactName').textContent = this.dataset.name;
            document.getElementById('modalContactGender').textContent = this.dataset.gender;
            document.getElementById('modalContactEmail').textContent = this.dataset.email;
            document.getElementById('modalContactTel').textContent = this.dataset.tel;
            document.getElementById('modalContactAddress').textContent = this.dataset.address;
            document.getElementById('modalContactBuilding').textContent = this.dataset.building;
            document.getElementById('modalContactCategory').textContent = this.dataset.categoryContent;
            document.getElementById('modalContactDetail').innerHTML = this.dataset.detail.replace(/\n/g, '<br>');

            const contactId = this.dataset.contactId;
            deleteForm.action = `/admin/contacts/` + contactId;

            modal.style.display = 'flex';
        });
    });

    /* モーダルウィンドウの閉じるボタンをクリックしたらモーダルウィンドウを閉じる */
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });

    /* モーダルウィンドウの背景をクリックしたらモーダルウィンドウを閉じる */
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>