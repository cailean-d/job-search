<div class="modal fade ns" id="modal_reg" tabindex="-1" role="dialog" aria-labelledby="abc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="abc">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registration">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Имя">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Фамилия">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-at"></i>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Почта">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user-secret"></i>
                            </div>
                            <select name="type" class="form-control custom-select">
                                <option value="" disabled selected>Тип учетной записи</option>
                                <option value="0">Пользователь</option>
                                <option value="1">Работодатель</option>
                            </select>
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль">
                        </div>
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <input type="submit" id="sub_form_reg" hidden>
                </form>
            </div>
            <div class="modal-footer d-block">
                <label for="sub_form_reg" class="btn btn-primary btn-block btn-lg" role="button" id="send_form_reg">Регистрация</label>
                <div class="hidden-xl-down ml-0" id="ajax-error-reg">
                    <hr>
                    <div class="error-block form-control-feedback text-center mb-2 bg-danger text-white rounded p-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
