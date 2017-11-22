<div class="reg">
    <form method="post" action="../scripts/reg.php" id="registration">
        <div class="option">
            <h3>Имя</h3>
            <input name="firstname" type="text" placeholder="Имя" maxlength="30">
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Фамилия</h3>
            <input name="lastname" type="text" placeholder="Фамилия" maxlength="30">
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Почта</h3>
            <input name="email" type="text" placeholder="Email" maxlength="30">
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Тип учетной записи</h3>
            <select name="type">
                <option value="0">Пользователь</option>
                <option value="1">Работодатель</option>
            </select>
        </div>
        <div class="option">
            <h3>Пароль</h3>
            <input name="password" type="password" placeholder="Пароль" maxlength="30">
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Повторите пароль</h3>
            <input name="password2" type="password" placeholder="Повторите пароль" maxlength="30">
            <div class="error"></div>
        </div>
        <input type="submit" value="Зарегистрироваться">
    </form>
</div>