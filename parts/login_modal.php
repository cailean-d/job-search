<!-- Modal Login -->
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
                <form action="scripts/login.php" method="post" id="login">
                    <div class="form-group">
                        <label for="email" class="form-control-label">Почта :</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Пароль :</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="error-block form-control-feedback text-center mb-2 hidden-xl-down"></div>
                    </div>
                    <input type="submit" id="sub_form" hidden>
                </form>
            </div>
            <div class="modal-footer d-block">
                <label for="sub_form" class="btn btn-primary btn-block btn-lg" role="button" id="send_form">Войти</label>
                <div class="hidden-xl-down ml-0" id="ajax-error">
                    <hr>
                    <div class="error-block form-control-feedback text-center mb-2 bg-danger text-white rounded p-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert -->
<div class="modal fade ns" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary hand btn-close" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>