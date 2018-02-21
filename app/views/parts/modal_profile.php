<div class="modal fade ns" id="__modal_profile" tabindex="-1" role="dialog" aria-labelledby="abc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="abc">Профиль</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="__profile_update_form">
                    
                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text" class="form-control" name="firstname" placeholder="Имя" value="<?=$user['firstname']?>">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text" class="form-control" name="lastname" placeholder="Фамилия" value="<?=$user['lastname']?>">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-at"></i>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Почта" value="<?=$user['email']?>">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon input-type">
                                <i class="fas fa-transgender"></i>
                            </div>
                            <select name="gender" class="form-control custom-select">
                                <option value="" disabled selected>Пол</option>
                                <option value="Мужской" <?= ($user['gender'] == 'Мужской') ? 'selected' : '' ?>>Мужской</option>
                                <option value="Женский" <?= ($user['gender'] == 'Женский') ? 'selected' : '' ?>>Женский</option>
                            </select>
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" name="old_password" placeholder="Старый пароль">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Пароль">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <div class="form-group __field">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" name="password2" placeholder="Повторите пароль">
                        </div>
                        <div class="__error_msg form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>

                    <input type="submit" id="__save_profile" hidden disabled>
                    
                </form>
            </div>
            <div class="modal-footer d-block">
                <label for="__save_profile" class="btn btn-primary btn-block btn-lg disabled" role="button" id="__save_profile_label" disabled>Сохранить</label>
                <div class="__error-outer hidden-xl-down ml-0">
                    <hr>
                    <div class="__error-inner form-control-feedback text-center mb-2 text-white rounded p-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
