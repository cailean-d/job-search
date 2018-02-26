<div class="modal fade ns" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="abc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="abc">Войти</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-at"></i>
                            </div>
                            <input type="text" class="form-control" name="email" placeholder="Почта">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Пароль">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <input type="submit" id="sub_form" hidden>
                </form>
            </div>
            <div class="modal-footer d-block">
                <label for="sub_form" class="btn btn-primary btn-block btn-lg" role="button" id="send_form">
                    Войти
                </label>
                <div class="hidden-xl-down ml-0" id="ajax-error">
                    <hr>
                    <div class="error-block form-control-feedback text-center mb-2 bg-danger text-white rounded p-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>