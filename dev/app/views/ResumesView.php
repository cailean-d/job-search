<main class="col-9 d-block mx-auto">
    <?php 
    if(count($resumes) == 0) : ?>
        <div class="alert alert-info __alert-vacancy" role="alert">
            <strong>Не найдено ни одного резюме.</strong>
        </div>
    <?php else : 
        foreach($resumes as $resume) :?>
            <div class="card vacancy_block">
                <div class="card-block">
                    <article class='resume'>
                        <div class="side">
                            <div class="avatar">
                            <img src="<?=($resume->getAvatar()) ? $resume->getAvatar() : 'public/images/user.jpg'?>" alt="" class="img-thumbnail rounded __resume_avatar" draggable="false">
                            </div>
                        </div>
                        <div class="main">
                            <header>
                                <a href='resume/<?=$resume->getUserid()?>'>
                                    <?=$resume->getUser()->getFirstname() .' '. $resume->getUser()->getLastname()?>
                                </a>
                            </header>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted" style="width: 200px;">Пол</th>
                                        <td><?=$resume->getUser()->getGender()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Дата рождения</th>
                                        <td><?=$resume->getBirthday()?> г.</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$resume->getCity()?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                </div>
            </div>
        <?php endforeach; 
    endif ?>
</main>
