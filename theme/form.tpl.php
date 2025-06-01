<!DOCTYPE html>
<html lang="ru">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./scripts/slick.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     <link rel="stylesheet"  href="./styles/style.css">
    <link rel="stylesheet"  href="./styles/slick.css"> 
    <link rel="stylesheet"  href="./styles/header-style.css"> 
    <script src="./scripts/form.js" defer></script>
    <script src="./scripts/buttons.js" defer></script>
    <script src="./scripts/slider.js" defer></script>
    <title>Web-project</title>
</head>


<body>
    <div class="container-fluid page">
      <div class="b-header row d-flex mb-2">
        <header> 
           <div class="header__video">
              <video class="h-vid"  loop autoplay muted>
                  <source src="./styles/img/video.mp4" type="video/mp4">
              
              </video>
           </div>
          
                <div class="navigation row d-flex mt-5 ">
                  <div class="nav-cont container">
                      <nav class="navbar">
                        
                          <div class="logo-menu col-md-2 float-md-left order-1 order-md-0">
                            <a href="form.tpl.php">
                              <img id="logo" src="./styles/img/drupal-coder.svg" alt="" width="140" height="20">
                            </a>
                              <label class="" for="menu" id="menu1" style="background-image: url(../style/image/менюю.png);">≡</label>
                          </div>

                        <div class="col-md-12 col-lg-10 px-0 justify-content-around">
                            <input type="checkbox" name="menu" id="menu">
                            <ul class="menu-none p-0 py-md-0 m-md-0 w-md-auto">
                                <li class="li-menu py-2 px-3 float-md-left"> <a  href="index.html" class="nav-link p-0 text-md-center"> ПОДДЕРЖКА DRUPAL </a></li>

                                <li class="pt-2 pt-md-0 py-md-2 px-md-3 float-md-left">  
                                    <div class="dropdown">
                                        <form action="form.tpl.php" class="li-menu">
                                            <button class="dropbtn pb-2 pb-md-0 px-md-0 px-3"> АДМИНИСТРИРОВАНИЕ <img src="./styles/img/arrow-lang.svg" alt=""> </button>
                                        </form>
                                        <div class="dropdown-content">
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">МИГРАЦИЯ</a>
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">БЭКАПЫ</a>
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">АУДИТ БЕЗОПАСНОСТИ</a>
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">ОПТИМИЗАЦИЯ СКОРОСТИ</a>
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">ПЕРЕЕЗД НА HTTPS</a>
                                        </div>
                                    </div>
                                  </li>
                                  <li class="li-menu py-2 px-3 float-md-left"> <a  href="index.php" class="nav-link p-0 text-md-center"> ПРОДВИЖЕНИЕ</a></li>
                                  <li class="pt-2 py-md-2 px-md-3 float-md-left">  
                                        <div class="dropdown">
                                          <form action="form.tpl.php" class="li-menu">
                                              <button class="dropbtn pb-2 pb-md-0 px-md-0 px-3 pt-md-0"> О НАС <img src="./styles/img/arrow-lang.svg" alt=""> </button>
                                          </form>
                                        <div class="dropdown-content">
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">КОМАНДА</a>
                                            <a class="down-links li-menu py-2 px-5 px-md-3" href="form.tpl.php">ВАКАНСИИ</a>
                                        </div>
                                      </div> 
                                  </li>
                                  
                                  <li class="li-menu py-2 px-3 float-md-left"> <a  href="form.tpl.php" class="nav-link p-0 text-md-center"> ПРОЕКТЫ </a></li>
                                  <li class="li-menu py-2 px-3 float-md-left"> <a  href="form.tpl.php" class="nav-link p-0 text-md-center"> КОНТАКТЫ </a></li>
                              </ul>
                        </div>
                             
                    </nav>
                  </div>

                <div class="container"> 
                <div class="header-cont container d-flex col-md-12 py-md-5 px-md-0 mx-md-0 my-4 ">
                    <div class="right-col col-md-6 pr-4 mr-md-4">
                      <div class="header-title">
                        Поддержка сайтов на Drupal
                      </div>
                        
                      <div class="header-text-info py-md-2">
                          Сопровождение и поддержка сайтов на CMS Drupal любых версий и запущенности
                      </div>
                        
                      <div class="button-tariff col-md-5 my-4 px-0">
                        <div class="block-main-wrapper">
                          <a href="#myform" class="block-main-btn flowing-scroll">РЕГИСТРАЦИЯ</a>
                        </div>

                      </div>

                    </div>
                    
                    <div class="row pl-2 ml-md-2">
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          
                          <h1>#1 <img src="./styles/img/cup.png" alt=""></h1> 
                          <p class="">  Drupal-разрабочтик в России по версии Рейтинга Рунета </p>
                        </div>
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          <h2>3+</h2><p class=""> средний опыт специалистов более 3 лет</p>
                          
                        </div>
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          <h2>14</h2><p class=""> лет опыта в сфере Drupal </p>
                          
                        </div>
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          <h2>50+</h2><p class=""> модулей и тем в формает DrupalGive</p>
                        </div>
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          <h2>90 000+</h2><p class=""> часов поддержки на Drupal </p>
                          
                        </div>
                        <div class="advantages-header col-6 col-lg-4 my-3">
                          <h2>300+</h2><p class=""> Проектов на поддержке </p>
                          
                        </div>
                    </div>
                </div>
              </div>
          </div>
          
        </header>
      </div>
    </div>

  <div class="b-main">

    <div class="b-info-1 container">
      <h2 class="mb-3 px-3"> 13 лет совершенствуем <br> компетенции в Друпал <br> поддержке! </h2>
      <p class="mb-5 px-3"> Разрабатываем и оптимизируем модули, расширяем <br> функциональность сайтов, обновляем дизайн </p>

      <div class="row d-flex">

        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-2 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-1" src="./styles/img/competency-1.svg">
            </div>
            <p class="col-12 my-0 p-3"> Добавление информации на сайт, создание новых разделов</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-2" src="./styles/img/competency-2.svg">
            </div>
            <p class="col-12 my-0 p-3"> Разработка и оптимизация модулей сайта</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-3" src="./styles/img/competency-3.svg">
            </div>
            <p class=" col-12 my-0 p-3"> Интеграция с CRM, 1C, платежными системами, любыми веб-сервисами</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-4" src="./styles/img/competency-4.svg">
            </div>
            <p class="col-12 my-0 p-3"> Любые доработки функционала и дизайна</p>
          </div>
        </div>  
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-5" src="./styles/img/competency-5.svg">
            </div>
            <p class="col-12 my-0 p-3"> Аудит и мониторинг безопасности Drupal сайтов</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-6" src="./styles/img/competency-6.svg">
            </div>
            <p class="col-12 my-0 p-3"> Миграция, импорт контента и апгрейд Drupal</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-7" src="./styles/img/competency-7.svg">
            </div>
            <p class="col-12 my-0 p-3"> Оптимизация и ускорение Drupal-сайтов</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mx-0 px-2">
          <div class="inf-1-block row d-flex justify-content-around m-1 p-2">
            <div class="inf-1-img col-12 d-flex justify-content-around">
              <img alt="comp-8" src="./styles/img/competency-8.svg">
            </div>
            <p class="col-12 my-0 p-3"> Веб-маркетинг, консультации и работы по SEO</p>
          </div>
        </div>
            
      </div>
    </div>

    <div class="container">
      <div class="b-info-2 col-12 mx-0 px-0 pb-5">
        <h2 class="block-name mb-4"> Поддержка <br> от Drupal-coder </h2>

        <div class="squares row d-flex p-0 mx-0">

          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-1" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">01.</div>
                <h3 class="square-title p-0 mb-3">Постановка задачи по Email</h3>
                <p class="square-body p-0 m-0"> Удобная и привычная модель постановки задач, при которой задачи фиксируются и никогда не теряются.</p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-2" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">02.</div>
                <h3 class="square-title p-0 mb-3"> Система Helpdesk – отчетность, прозрачность </h3>
                <p class="square-body p-0 m-0"> Возможность посмотреть все заявки в работе и отработанные часы в личном кабинете через браузер.</p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-3" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">03.</div>
                <h3 class="square-title p-0 mb-3"> Расширенная техническая поддержка </h3>
                <p class="square-body p-0 m-0"> Возможность организации расширенной техподдержки с 6:00 до 22:00 без выходных. </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-4" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">04.</div>
                <h3 class="square-title p-0 mb-3"> Персональный менеджер проекта </h3>
                <p class="square-body p-0 m-0"> Ваш менеджер проекта всегда в курсе текущего состояния проекта и в любой момент готов ответить на любые вопросы. </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-5" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">05.</div>
                <h3 class="square-title p-0 mb-3"> Удобные способы оплаты </h3>
                <p class="square-body p-0 m-0"> Безналичный расчет по договору или электронные деньги: WebMoney, Яндекс.Деньги, Paypal. </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-6" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">06.</div>
                <h3 class="square-title p-0 mb-3"> Работаем с SLA и NDA </h3>
                <p class="square-body p-0 m-0"> Работа в рамках соглашений о конфиденциальности и об уровне качества работ. </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-7" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">07.</div>
                <h3 class="square-title p-0 mb-3"> Штатные специалисты </h3>
                <p class="square-body p-0 m-0"> Надежные штатные специалисты, никаких фрилансеров. </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 my-1 px-2">
            <div id="sq-8" class="square-wrapper px-3 pt-3 pb-5">
                <div class="square-num p-0 mb-3">08.</div>
                <h3 class="square-title p-0 mb-3"> Удобные каналы связи </h3>
                <p class="square-body p-0 m-0"> Консультации по телефону, скайпу, в месенджерах. </p>
            </div>
          </div>

        </div>
      </div>
    </div>


   <div class="b-info-3 ">

        <div class="container">
          <div class="row">
            <div class="inf-3-body col-md-12 col-lg-6 col-xs-12 col-md-offset-6">
              <div class="row">
                <h2 class="col-12 mb-5 mt-3"> Экспертиза в Drupal, <br> опыт 14 лет! </h2>
              </div>

              <div class="row row-flex">

                <div class="col-sm-6 col-xs-12 inf-3-col">
                  <div class="inf-3-item">
                    <p>
                      Только системный подход – контроль версий, резервирование и тестирование!
                    </p>
                  </div>
                </div>

                <div class="col-sm-6 col-xs-12 inf-3-col">
                  <div class="inf-3-item">
                    <p>
                      Только Drupal сайты, не берем на поддержку сайты на других CMS!
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12 inf-3-col">
                  <div class="inf-3-item">
                    <p>
                      Участвуем в разработке ядра Drupal и модулей на Drupal.org, разрабатываем
                      <a href="index.html"> свои модули Drupal</a>
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12 inf-3-col">
                  <div class="inf-3-item">
                    <p>
                      Поддерживаем сайты на Drupal 5, 6, 7 и 8
                    </p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        
        <div class="side-image">
          <img alt="side-laptop" src="./styles/img/laptop.png">
        </div>
    </div>



    <section id="pricing" class="pricing">
        <h2>Тарифы</h2>
        <div class="pricing-grid">
          <div class="pricing-plan">
            <h3>Стартовый</h3>
            <div class="price">
                2000
                <div class="rubles">₽</div>
            </div>
            <div class="atHour">
                в час
            </div>
            <div class="line"></div>
            <ul>
              <li>Консультации и работы по SEO</li>
              <li>Услуги дизайнера</li>
              <li>Обычное время реакции - до 7 рабочих дней</li>
              <li>Неиспользованные оплаченные часы переносятся на следующий месяц</li>
              <li>Предоплата от 6 000 рублей в месяц</li>
            </ul>
            <a href="#myform" class="btn">Выбрать</a>
          </div>
          <div class="pricing-plan">
            <h3>Бизнес</h3>
            <div class="price">
                1800
                <div class="rubles">₽</div>
            </div>
            <div class="atHour">
                в час
            </div>
            <div class="line"></div>
            <ul>
              <li>Консультации и работы по SEO</li>
              <li>Услуги дизайнера</li>
              <li>Высокое время реакции - до 2 рабочих дней</li>
              <li>Неиспользованные оплаченные часы не переносятся на следующий месяц</li>
              <li>Предоплата от 30 000 рублей в месяц</li>
            </ul>
            <a href="#myform" class="btn">Выбрать</a>
          </div>
          <div class="pricing-plan">
            <h3>VIP</h3>
            <div class="price">
                2000
                <div class="rubles">₽</div>
            </div>
            <div class="atHour">
                в час
            </div>
            <div class="line"></div>
            <ul>
              <li>Консультации и работы по SEO</li>
              <li>Услуги дизайнера</li>
              <li>Максимальное время реакции - в день обращения</li>
              <li>Неиспользованные оплаченные часы не переносятся</li>
              <li>Предоплата от 270 000 рублей в месяц</li>
            </ul>
            <a href="#myform" class="btn">Выбрать</a>
          </div>
        </div>
      </section>


    <div class="b-info-4 container">
      <div class="row d-flex">
        <h2 class="col-12 order-0"> Наши профессиональные разработчики выполняют быстро любые задачи </h2>

        <div class="col-md-4 col-12 mx-0 px-2 d-flex justify-content-around">
          <div class="inf-4-block row d-flex justify-content-around m-2 p-2">
            <div class="inf-4-img col-12 d-flex justify-content-around">
              <img alt="c-1" src="./styles/img/competency-20.svg">
            </div>
            <h3 class="col-12"> от 1ч </h3>
            <p class="col-12"> Настройка события GA в интернет-магазине </p>
          </div>
        </div>
        <div class="col-md-4 col-12 mx-0 px-2 d-flex justify-content-around">
          <div class="inf-4-block row d-flex justify-content-around m-2 p-2">
            <div class="inf-4-img col-12 d-flex justify-content-around">
              <img alt="c-2" src="./styles/img/competency-21.svg">
            </div>
            <h3 class="col-12"> от 20ч </h3>
            <p class="col-12"> Разработка мобильной версии сайта </p>
          </div>
        </div>
        <div class="col-md-4 col-12 mx-0 px-2 d-flex justify-content-around">
          <div class="inf-4-block row d-flex justify-content-around m-2 p-2">
            <div class="inf-4-img col-12 d-flex justify-content-around">
              <img alt="c-3" src="./styles/img/competency-22.svg">
            </div>
            <h3 class="col-12"> от 8ч </h3>
            <p class="col-12"> Интеграция модуля оплаты </p>
          </div>
        </div>
          
      </div>
    </div>



    <div class="b-team container">
      <div class="row d-flex">
        <h2 class="block-name my-3 col-12 order-0"> Команда</h2>

        <div class="team-block col-6 col-md-4 row d-flex justify-content-around m-0">
          <img class="col-12 mb-3" alt="c-1" src="./styles/img/IMG_2472_0.jpg">
          <h3 class="col-12"> Сергей Синица </h3>
          <p class="col-12"> Руководитель отдела веб- разработки, канд. техн. наук, заместитель директора</p>
        </div>
        <div class="team-block col-6 col-md-4 row d-flex justify-content-around m-0">
          <img class="col-12 mb-3" alt="c-2" src="./styles/img/IMG_2539_0.jpg">
          <h3 class="col-12"> Роман Агабеков</h3>
          <p class="col-12"> Руководитель отдела DevOPS, директор</p>
        </div>
        <div class="team-block col-6 col-md-4 row d-flex justify-content-around m-0">
          <img class="col-12 mb-3" alt="c-3" src="./styles/img/IMG_2474_1.jpg">
          <h3 class="col-12"> Алексей Синица </h3> 
          <p class="col-12"> Руководитель отдела поддержки сайтов</p>
        </div>
        <div class="team-block col-6 col-md-4 row d-flex justify-content-around m-0">
          <img class="col-12 mb-3" alt="c-4" src="./styles/img/IMG_2522_0.jpg">
          <h3 class="col-12"> Дарья Бочкарёва</h3>
          <p class="col-12"> Руководитель отдела продвижения, контекстной рекламы и контент-поддержки сайтов</p>
        </div>
        <div class="team-block col-6 col-md-4 row d-flex justify-content-around m-0">
          <img class="col-12 mb-3"  alt="c-5" src="./styles/img/IMG_9971_16.jpg">
          <h3 class="col-12"> Ирина Торкунова</h3>
          <p class="col-12"> Менеджер по работе с клиентами</p>
        </div>

        <div class="btn-open col-12"> <button class="p-2" id="open-button"> ВСЯ КОМАНДА </button></div>
      </div>
    </div>


    <div class="b-case container my-3">
      <h2 class="block-name">Последние кейсы</h2>

      <div class="row d-flex">

        <article class="case-block col-12 col-md-4 p-0 m-0">
          <div class="case-wrapper m-2 px-3 pb-3 pt-0">
            <div class="case-img-wrapper">
              <a href="index.html"><img alt="case-1" src="./styles/img/case-1.png"></a>
            </div>
            <div class="p-3">
              <div class="mb-3">
                <h3 class="m-0"><a  class="case-title" href="index.html">Настройка кэширования данных. Апгрейд сервера. Ускорение работы сайта в 30 раз!</a></h3>
                <span ><a class="case-date" href="index.html">04.05.2020</a></span>
              </div>
            <p ><a class="case-text" href="index.html"> Влияние скорости загрузки страниц сайта на отказы и конверсии. Кейс ускорения...</a></p>
            </div>
          </div>
        </article>
        <article class="case-block col-12 col-md-8 p-0 m-0 d-flex">
          <div class="case-wrapper-2 my-2 mx-4 mx-md-2 px-0">
              <div class="case-img-wrapper-2 m-0 p-0">
                <a href="index.html"><img alt="case-2" src="./styles/img/case-2.png"></a>
              </div>
              <div class="case-2-text px-4 px-md-3 py-5">
                <h3 class="m-0"><a  class="case-2-title" href="index.html">Использование отчетов Ecommerce в Яндекс.Метрике</a></h3>
              </div>
            </div>
        </article>
        <article class="case-block col-12 col-md-4 p-0 m-0 d-flex">
          <div class="case-wrapper-2 my-2 mx-4 mx-md-2 px-0">
              <div class="case-img-wrapper-2 m-0 p-0">
                <a href="index.html"><img alt="case-3" src="./styles/img/case-3.png"></a>
              </div>
              <div class="case-2-text px-4 px-md-3 py-4">
                <h3 class="m-0"><a  class="case-2-title" href="index.html">Повышение конверсии страницы с формой заявки с применением AB-тестирования</a></h3>
              <span ><a class="case-2-date" href="index.html">24.01.2020</a></span>
              </div>
            </div>
        </article>
        <article class="case-block col-12 col-md-4 p-0 m-0 d-flex">
          <div class="case-wrapper-2 my-2 mx-4 mx-md-2 px-0">
              <div class="case-img-wrapper-2 m-0 p-0">
                <a href="index.html"><img alt="case-4" src="./styles/img/case-4.png"></a>
              </div>
              <div class="case-2-text px-4 px-md-3 py-4">
                <h3 class="m-0"><a  class="case-2-title" href="index.html">Drupal 7: ускорение времени генерации страниц интернет-магазина на 32%</a></h3>
                <span ><a class="case-2-date" href="index.html">23.09.2019</a></span>
              </div>
            </div>
        </article>
        <article class="case-block col-12 col-md-4 p-0 m-0">
          <div class="case-wrapper m-2 px-3 pb-3 pt-0">
            <div class="case-img-wrapper">
              <a href="index.html"><img alt="case-5" src="./styles/img/case-5.png"></a>
            </div>
            <div class="p-3">
              <div class="mb-3">
                <h3 class="m-0"><a  class="case-title" href="index.html">Обмен товарами и заказами интернет-магазинов на Drupal 7 с 1С: Предприятие, МойСклад, Класс365</a></h3>
                <span ><a class="case-date" href="index.html">22.08.2019</a></span>
              </div>
            <p ><a class="case-text" href="index.html">Опубликован <span class="case-additional-text">релиз модуля...</span></a></p>
            </div>
          </div>
        </article>

      </div>
    </div>

    <div class="rev-wrapper">
      <div class="container">
        <div class="b-reviews">
          <h2 class="block-name mb-5"> Отзывы </h2>

          <div class="view-slider mt-5 ">
            <div class="b-slider p-4 mx-lg-5 mx-2 row d-flex">
              <div class="single-item col-12 col-md-8">

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-1" src="./styles/img/logo_0.png">
                  <div class="slide-body">
                    Долгие поиски единственного и неповторимого мастера на многострадальный сайт www.cielparfum.com, 
                    который был собран крайне некомпетентным программистом и раз в месяц стабильно грозил погибнуть,
                    привели меня на сайт и, в итоге, к ребятам из Drupal-coder. И вот уже практически полгода как не 
                    проходит и дня, чтобы я не поудивлялась и не порадовалась своему везению! Починили все, что не 
                    работало - от поиска до отображения меню. Провели редизайн - не отходя от желаемого, но со своими 
                    существенными и качественными дополнениями. Осуществили ряд проектов - конкурсы, тесты и тд. А уж 
                    мелких починок и доработок - не счесть! И главное - все качественно и быстро (не взирая на не 
                    самый "быстрый" тариф). Есть вопросы - замечательный Алексей всегда подскажет, поддержит, 
                    отремонтирует и/или просто сделает с нуля. Есть задумка для реализации - замечательный Сергей 
                    обсудит и предложит идеальный вариант. Есть проблема - замечательные Надежда и Роман починят, 
                    поправят, сделают! Ребята доказали, что эта CMS - мощная и грамотная система управления. Надеюсь, 
                    что наше сотрудничество затянется надолго! Спасибо!!!
                  </div>
                  <div class="slide-bot">
                    С уважением, Наталья Сушкова руководитель Отдела веб-проектов Группы компаний «Си Эль парфюм» 
                    <a href="http://www.cielparfum.com/" tabindex="0">http://www.cielparfum.com/</a>
                  </div>
                </div>
                  
               <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-2" src="./styles/img/logo.png">
                  <div class="slide-body">
                    Сергей — профессиональный, высококвалифицированый программист
                    с огромным опытом в ИТ. Я долгое время общался с топ-фрилансерами
                    (вся первая двадцатка) на веблансере и могу сказать, что С СЕРГЕЕМ 
                    ОНИ И РЯДОМ НЕ ВАЛЯЛИСЬ. Работаем с Сереем до сих пор. С ним приятно
                    работать, я доволен.
                  </div>
                  <div class="slide-bot">
                    Сергей Чепуренко, руководитель проекта
                    <a href="www.personal-writer.com/www.writers-united.org" tabindex="0">www.personal-writer.com/www.writers-united.org </a>
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-3" src="./styles/img/farbors_ru.jpg">
                  <div class="slide-body">
                    Выражаю глубочайшую благодарность команде специалистов компании "Инитлаб"
                    и лично Дмитрию Купянскому и Алексею Синице. Сайт был первоклассно перевёрстан
                    из старой табличной модели в новую на базе Drupal с дополнительной функциональностью.
                    Всё было сделано с высочайшим качеством и точно в сроки. Всем кому хочется без нервов
                    и лишних вопросов разработать сайт рекомендую обращаться именно к этой команде профессионалов.
                  </div>
                  <div class="slide-bot">
               Леонид Александрович Ледовский
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-4" src="./styles/img/nashagazeta_ch.png">
                  <div class="slide-body">
                    Моя электронная газета www.nashagazeta.ch существует в Швейцарии уже 10 лет.
                    За это время мы сменили 7 специалистов по техподдержке, и только сейчас, в 
                    последние несколько месяцев, с начала сотрудничества с Алексеем Синицей и его
                    командой, я впервые почувствовала, что у меня есть надежный технический тыл. 
                    Без громких слов и обещаний, ребята просто спокойно и качественно делают работу,
                    быстро реагируют, находят решения, предлагают конкретные варианты улучшения функционирования
                    сайта и сами их оперативно осуществляют. Сотрудничество с ними - одно удовольствие!
                  </div>
                  <div class="slide-bot">
                    Надежда Сикорская, Женева, Швейцария
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-5" src="./styles/img/logo-estee.png">
                  <div class="slide-body">
                    Наша компания Estee Design занимается дизайном интерьеров. Сайт сверстан на Drupal.
                    Искали программистов под выполнение ряда небольших изменений и корректировок по сайту. 
                    Пообщавшись с Алексеем Синицей, приняли решение о начале работ с компанией Initlab/drupal-coder.
                    Сотрудничеством довольны на 100%. Четкая и понятная система коммуникации, достаточно оперативное
                    решение по задачам. Дали рекомендации по улучшению програмной части сайта, исправили ряд скрытых
                    ошибок. Никогда не пишу отзывы (нет времени), но в данном случае, по просьбе Алексея, не могу не
                    рекомендовать Initlab другим людям - действительно компания профессионалов.
                  </div>
                  <div class="slide-bot">
                    Кузин Вадим, руководитель строительного направления Дизайн-бюро интерьеров Estee
                    <a href="https://estee-design.ru/" tabindex="0"> https://estee-design.ru/ </a>
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-6" src="./styles/img/cableman_ru.png">
                  <div class="slide-body">
                    Наша компания за несколько лет сменила несколько команд программистов и специалистов техподдержки,
                    и почти отчаялась найти на российском рынке адекватное профессиональное предложение по разумной цене.
                    Пока мы не начали работать с командой "Инитлаб", воплощающей в себе все наши представления о нормальной
                    системе взаимодействия в сочетании с профессиональным неравнодушием. Впервые в моей деловой практике я
                    чувствую надежно прикрытыми важнейшие задачи в жизни электронного СМИ, при том, что мои коллеги работают
                    за сотни километров от нас и мы никогда не встречались лично.
                  </div>
                  <div class="slide-bot">
                    Константин Бельский, зам. генерального директора портала
                    <a href="https://www.cableman.ru/" tabindex="0"> Кабельщик.ру </a>
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-7" src="./styles/img/logo_2.png">
                  <div class="slide-body">
                    За довольно продолжительный срок (2014 - 2016 годы) весьма плотной работы 
                    (интернет-магазин на безумно замороченном Drupal 6: устраняли косяки разработчиков,
                    ускоряли сайт, сделали множество новых функций и т.п.) - только самые добрые эмоции
                    от работы с командой Initlab / Drupal-coder: всегда можно рассчитывать на быструю и
                    толковую помощь, поддержку, совет. Даже сейчас, не смотря на то, что мы почти год не
                    работали на постоянной основе (банально закончились задачи), случайно возникшая проблема
                    с сайтом была решена мгновенно! В общем, только самые искренние благодарности и рекомендации!
                    Спасибо!)
                  </div>
                  <div class="slide-bot">
                    С уважением, Владислав,
                    <a href="http://serebro.ag/" tabindex="0"> Serebro.Ag </a>
                  </div>
                </div>

                <div class="slide p-2 col-12 col-md-8">
                  <img class="mb-4" alt="rev-logo-8" src="./styles/img/lpcma_rus_v4.jpg">
                  <div class="slide-body">
                   Хотел поблагодарить за работу над нашими сайтами. За 4 месяца работы привели сайт в порядок,
                   а самое главное получили инструмент, с помощью мы теперь можем быстро и красиво выставлять
                   контент для образования и работы с предприятиями http://Ipcma.tsu.ru/ru/post/reference_material
                   Hy многому научись благодаря работе с вами. Мы очень рады, что удалось найти настолько компетентных ребят) 
                  </div>
                  <div class="slide-bot">
                    Дмитрий Новиков, 
                    <a href="https://lpcma.tsu.ru/" tabindex="0"> Ipsma.tsu.ru </a>
                  </div>
                </div>

              </div>

              <nav class="slick-arrow-wrapper col-12 col-md-4 p-3 d-flex justify-content-around">
                <div class="slick-arrow d-flex" >
                  <button id="my-arrow-prev" class="slick-prev slick-arrow" aria-label="Previous" type="button">Previous</button>
                  <span class="slide-num px-3 py-2">
                    <span class="slide-num-current" id="slide-current-number">01</span> / 08
                  </span>
                  <button id="my-arrow-next" type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" >Next</button>
                </div>
              </nav>

            </div>
          </div>
        </div>
      </div>
    </div>
      

     <div class="b-slider-2">
      <div class="slider-2-head container">
        <h2 class="block-name px-5"> С нами работают </h2>
        <p class="px-2"> Десятки компаний доверяют нам самое ценное, что у них есть в интернете - 
            свои сайты. Мы делаем всё, чтобы наше сотрудничество было долгим.
        </p>
      </div>
        
      <div class="auto-slider-1-wrapper">
        <div class="auto-slider-1">
          <div class="slider-1">

            <div class="slide-2-1 d-flex justify-content-around">
              <img alt="slide-2-logo-1" src="./styles/img/logo-2-1.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-2" src="./styles/img/logo-2-2.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-3" src="./styles/img/logo-2-3.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-4" src="./styles/img/logo-2-4.png">
            </div>
            <div class="slide-2-1 d-flex justify-content-around">
              <img alt="slide-2-logo-1" src="./styles/img/lpcma_rus_v4.jpg">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-2" src="./styles/img/farbors_ru.jpg">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-3" src="./styles/img/logo_0.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-4" src="./styles/img/nashagazeta_ch.png">
            </div>

          </div>
        </div>
      </div>

      <div class="auto-slider-1-wrapper">
        <div class="auto-slider-1">
          <div class="slider-2">

            <div class="slide-2-1 d-flex justify-content-around">
              <img alt="slide-2-logo-1" src="./styles/img/logo-2-1.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-2" src="./styles/img/logo-2-2.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-3" src="./styles/img/logo-2-3.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-4" src="./styles/img/logo-2-4.png">
            </div>
            <div class="slide-2-1 d-flex justify-content-around">
              <img alt="slide-2-logo-1" src="./styles/img/logo-2-1.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-2" src="./styles/img/logo-2-2.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-3" src="./styles/img/logo-2-3.png">
            </div>
            <div class="slide-2-1">
              <img alt="slide-2-logo-4" src="./styles/img/logo-2-4.png">
            </div>

          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
      <div class="b-accordion">
        <h2 class="block-name mb-4"> FAQ </h2>

        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">1.</h4>
            <h3 class="p-1 mb-1">Кто непосредственно занимается поддержкой?</h3>
          </div>
          <p class="pl-4">Сайты поддерживают штатные сотрудники ООО «Инитлаб», г.Краснодар, прошедшие специальное обучение
            и имеющие опыт работы с Друпал от 4 до 15 лет: 8 web-разработчиков, 2 специалиста по SEO, 4 системных администратора.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">2.</h4>
            <h3 class=" p-1 mb-1">Как организована работа поддержки?</h3>
          </div>
          <p class="pl-4">>Клиент выбирает один из тарифов и делает предоплату. Все заявки на работы по сайту заводятся в нашу систему Service desk. В течение времени реакции по тарифу закрепленный за проектом специалист приступает к выполнению заявки, фиксирует время, потраченное на выполнение заявки и закрывает заявку по окончанию работы. Клиент может посмотреть все заявки в работе и отработанные часы в своем кабинете через веб-интерфейс.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">3.</h4>
            <h3 class="p-1 mb-1">Что происходит, когда отработаны все предоплаченные часы за месяц?</h3>
          </div>
          <p class="pl-4">Мы уведомляем Клиента, о том, что последующие заявки в этом месяце будут выполняться с доплатой согласно тарифу либо будут перенесены по срокам на следующий месяц. В конце месяца, в котором были заявки с доплатой, клиентам отправляется счет на доплату по факту выполненных работ сверх предоплаты тарифного плана.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">4.</h4>
            <h3 class="p-1 mb-1">Что происходит, когда не отработаны все предоплаченные часы за месяц?</h3>
          </div>
          <p class="pl-4">Предоплата не переносится на следующий месяц и деньги не возвращаются. Для продолжения поддержки сайта необходимо оплатить предоплату согласно выбранному тарифу за следующий месяц.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">5.</h4>
            <h3 class="p-1 mb-1">Как происходит оценка и согласование планируемого времени на выполнение заявок?</h3>
          </div>
          <p class="pl-4">Заявки, выполнение которых укладывается в оставшееся предоплаченное время, по умолчанию не оцениваются и время не согласовывается, мы стараемся сэкономить время и быстро выполнить работу. Если видим, что задача не укладывается в предоплаченное время, то делаем примерную оценку по времени и согласовываем оценку трудоемкости с Клиентом. Клиент может явно попросить предварительно оценить работу по времени и согласовать трудоемкость, направив заявку с припиской в теме письма «Оценить работу». В этом случае время на оценку также оплачивается согласно тарифу поддержки. Если время фактического выполнения превышает заранее согласованное, то уточняем оценку, договариваемся о возможной доплате и переносе сроков по задаче. На наше усмотрение большие задачи, трудоемкость которых мы можем заранее оценить, например, разработка отдельных модулей или самостоятельных разделов сайта по подробному техническому заданию, могут быть вынесены из поддержки в отдельный проект на договорных условиях.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">6.</h4>
            <h3 class="p-1 mb-1">Сколько программистов выделяется на проект?</h3>
          </div>
          <p class="pl-4">1-2 человека. За каждым проектом закрепляется один ответственный специалист, через которого проходят все заявки. Все заявки становятся в очередь к ответственному в порядке их поступления в Helpdesk. Возможно привлечение дополнительных штатных специалистов в поддержку проекта в случаях, когда:
              объем заявок стабильно большой и ответственный не успевает выполнять задачи;
              ответственный не может начать работу по заявке в срок (заболел, ушел в отпуск);
              специфика задачи такова, что кто-то в команде сделает эту работу существенно быстрее.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">7.</h4>
            <h3 class="p-1 mb-1">Как подать заявку на внесение изменений на сайте?</h3>
          </div>
          <p class="pl-4">Для подачи заявки на внесение изменений на сайте необходимо написать письмо на email поддержки с указанием в теме письма домена сайта и подробным описанием вносимых изменений.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">8.</h4>
            <h3 class="p-1 mb-1">Как подать заявку на добавление пользователя, изменение настроек веб-сервера и других задач по администрированию?</h3>
          </div>
          <p class="pl-4">Для любых задач по администрированию необходимо написать письмо на email поддержки с указанием домена сайта и описанием задачи.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">9.</h4>
            <h3 class="p-1 mb-1">В течение какого времени начинается работа по заявке?</h3>
          </div>
          <p class="pl-4">>Время реакции зависит типа заявки и от выбранного тарифного плана. Время реакции на сбои, обнаруживаемые системой мониторинга, от 2-х часов в рабочее время. Время реакции на заявки по доработке сайта от 24-х часов в рабочее время. Время реакции может быть более гибко определено в SLA.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">10.</h4>
            <h3 class="p-1 mb-1">В какое время работает поддержка?</h3>
          </div>
          <p class="pl-4">Время работы поддержки с 10 до 18 часов (MSK, GMT+3) в рабочие дни. Мы также можем выполнять работы сверхурочно по договоренности с оплатой по двойной ставке часа.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">11.</h4>
            <h3 class="p-1 mb-1">Подходят ли услуги поддержки, если необходимо произвести обновление ядра Drupal или модулей?</h3>
          </div>
          <p class="pl-4">Обновление безопасности в рамках одной ветки Drupal делается в режиме поддержки на всех тарифных планах. Обновление, связанное с переходом на следующую ветку Drupal, например апгрейд с 6.х на 7.х, лучше делать в рамках отдельного проекта, стоимость и сроки которого мы можем предложить после проведения аудита апгрейда. Аудит апгрейда включает в себя анализ путей миграции и трудоемкости обновления для всех модулей, блоков кода, Views, тем оформления, стоит от 6500 рублей и, как правило, занимает 1-3 дня, в зависимости от размера сайта.</p>
        </div>
        <div class="p-2">
          <div class="d-flex">
            <h4 class="q-num p-1 mb-1 mt-1">12.</h4>
            <h3 class="p-1 mb-1">Можно ли пообщаться со специалистом голосом или в мессенджере?</h3>
          </div>
          <p class="pl-4">Для этого нужно написать заявку на консультацию на email поддержки и сообщить удобное время и контактные данные.</p>
        </div>
        
      </div>
    </div>

  </div>
    

<footer>
  <div class="bottom-wrapper container">
    <div class="b-bottom col-12 row d-flex pb-3 px-0 mx-0">
      <div class="b-footer-text col-md-6 order-1 order-md-1 col-12 p-1">
        <h2 class="block-name mb-3"> Оставить заявку на <br> поддержку сайта</h2>
        <p> Срочно нужна поддержка сайта? 
          Ваша команда не успевает справиться самостоятельно или предыдущий подрядчик не справился с работой?
           Тогда вам точно к нам! 
          Просто оставьте заявку и наш менеджер с вами свяжется! </p>

          <br>
          <div class="b-footer-info p-0">
            <span> <img src="./styles/img/phone.svg" alt="phone-sign" height="25" width="25"> 8 800 222-26-73 </span><br>
            <a href="index.html"> <img src="./styles/img/mail.svg" alt="mail-sign" height="25" width="25">info@drupal-coder.ru </a>
          </div>
      </div>

      <div class="b-form col-12 col-md-6 order-2 order-md-2 px-3 pb-3 pt-1 pt-md-3">
       <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
    <div class="auth-buttons">
  <?php if (!empty($_SESSION['login'])): ?>
    <form action="<?= url('logout') ?>" method="POST">
      <button type="submit" class="auth-btn">Выйти</button>
    </form>
  <?php else: ?>
    <a href="<?= url('login') ?>" class="auth-btn">Войти</a>
  <?php endif; ?>
</div>


        <div class="form-messages"></div>
        <div class="formstyle1">
          <form id="myform" class="application" method="POST" action="">
            <h2 class="white-text">ФОРМА</h2>

            <label>
              ФИО: <br/>
              <input type="text" name="fio" 
                     class="input-field <?= !empty($errors['fio']) ? 'error' : '' ?>" 
                     placeholder="Введите имя, фамилию и отчество"
                     value="<?= htmlspecialchars($values['fio'] ?? '') ?>"/>
              <?php if (!empty($errors['fio'])): ?>
                <span class="error-text"><?= $errors['fio'] ?></span>
              <?php endif; ?>
            </label><br/>

            <label>
              Телефон: <br />
              <input type="tel" name="phone" 
                     class="input-field <?= !empty($errors['phone']) ? 'error' : '' ?>" 
                     placeholder="+7XXXXXXXXXX"
                     value="<?= htmlspecialchars($values['phone'] ?? '') ?>"/>
              <?php if (!empty($errors['phone'])): ?>
                <span class="error-text"><?= $errors['phone'] ?></span>
              <?php endif; ?>
            </label><br/>

            <label>
              Email: <br/>
              <input type="email" name="email" 
                     class="input-field <?= !empty($errors['email']) ? 'error' : '' ?>" 
                     placeholder="example@mail.com"
                     value="<?= htmlspecialchars($values['email'] ?? '') ?>"/>
              <?php if (!empty($errors['email'])): ?>
                <span class="error-text"><?= $errors['email'] ?></span>
              <?php endif; ?>
            </label><br/>

            <label>
              Дата рождения: <br/>
              <div class="date-fields">
                <input type="number" name="birth_day" 
                       class="input-field date-input <?= !empty($errors['birth_day']) ? 'error' : '' ?>" 
                       placeholder="День" min="1" max="31"
                       value="<?= htmlspecialchars($values['birth_day'] ?? '') ?>"/>
                
                <input type="number" name="birth_month" 
                       class="input-field date-input <?= !empty($errors['birth_month']) ? 'error' : '' ?>" 
                       placeholder="Месяц" min="1" max="12"
                       value="<?= htmlspecialchars($values['birth_month'] ?? '') ?>"/>
                
                <input type="number" name="birth_year" 
                       class="input-field date-input <?= !empty($errors['birth_year']) ? 'error' : '' ?>" 
                       placeholder="Год" min="1900" max="<?= date('Y') ?>"
                       value="<?= htmlspecialchars($values['birth_year'] ?? '') ?>"/>
              </div>
              <?php if (!empty($errors['birth_date'])): ?>
                <span class="error-text"><?= $errors['birth_date'] ?></span>
              <?php endif; ?>
            </label><br/>

            <label class="white-text">
              Пол: <br/> 
              <div class="gender-options">
                <label>
                  <input type="radio" name="gender" value="male" 
                         class="<?= !empty($errors['gender']) ? 'error' : '' ?>"
                         <?= ($values['gender'] ?? '') === 'male' ? 'checked' : '' ?>>
                  Мужской
                </label>
                <label>
                  <input type="radio" name="gender" value="female" 
                         class="<?= !empty($errors['gender']) ? 'error' : '' ?>"
                         <?= ($values['gender'] ?? '') === 'female' ? 'checked' : '' ?>>
                  Женский
                </label>
              </div>
              <?php if (!empty($errors['gender'])): ?>
                <span class="error-text"><?= $errors['gender'] ?></span>
              <?php endif; ?>
            </label><br/>

           <label>
    Любимые языки программирования: <br/>
    <select name="languages[]" multiple="multiple" 
            class="input-field <?= !empty($errors['lang']) ? 'error' : '' ?>"
            style="height: auto; min-height: 100px; padding: 10px;">
        
        <?php 
         $user_languages = isset($values['languages']) ? $values['languages'] : [];
          foreach ($allowed_lang as $lang):
              ?>
            <option value="<?= htmlspecialchars($lang['id']) ?>"
           <?= in_array($lang['id'], $user_languages) ? 'selected="selected"' : '' ?>>
           <?= htmlspecialchars($lang['name']) ?>
        </option>
         <?php endforeach; ?>
         </select>
     <?php if (!empty($errors['languages'])): ?>
    <span class="error-text"><?= $errors['languages'] ?></span>
   <?php endif; ?>
   </label><br/>

            <label>
              Биография: <br/>
              <textarea name="biography" 
                        class="input-field <?= !empty($errors['biography']) ? 'error' : '' ?>"
                        placeholder="Расскажите о себе..."><?= htmlspecialchars($values['biography'] ?? '') ?></textarea>
              <?php if (!empty($errors['biography'])): ?>
                <span class="error-text"><?= $errors['biography'] ?></span>
              <?php endif; ?>
            </label><br/>

          <div class="checkbox-block">
                <label class="form-checkbox">
                    <input type="checkbox" name="agreement" 
                           class="custom-checkbox <?= !empty($errors['agreement']) ? 'error' : '' ?>"
                           <?= !empty($values['agreement']) ? 'checked' : '' ?>>
                    <span class="checkmark"></span>
                    Согласен(а) с <a href="#">обработкой персональных данных</a>
                </label>
                <?php if (!empty($errors['agreement'])): ?>
                    <span class="error-text"><?= $errors['agreement'] ?></span>
                <?php endif; ?>
            </div><br/>

            <input class="submit-btn" type="submit" 
                   value="<?= !empty($_SESSION['login']) ? 'Обновить данные' : 'Сохранить' ?>" 
                   id="submit-btn"/>
        </form>
    </div>

        <?php if (!empty($_SESSION['generated_login']) && !empty($_SESSION['generated_password']) && empty($_SESSION['login'])): ?>
          <div class="credentials">
            <h3>Ваши учетные данные:</h3>
            <p><strong>Логин:</strong> <?= htmlspecialchars($_SESSION['generated_login']) ?></p>
            <p><strong>Пароль:</strong> <?= htmlspecialchars($_SESSION['generated_password']) ?></p>
            <p>Используйте их для входа в следующий раз.</p>
          </div>
          <?php 
            unset($_SESSION['generated_login']);
            unset($_SESSION['generated_password']);
          ?>
        <?php endif; ?>
      </div>

      <div class="ftr col-12 order-3 order-md-3">
        <div class="footer-body p-0">
          <ul class="sns-wrapper row d-flex px-3">
            <li class="sns"><a title="Facebook" href="index.html"><img alt="logo-fb" src="./styles/img/logo-facebook.png"></a></li>
            <li class="sns"><a title="Вконтакте" href="index.html"><img alt="logo-vk" src="./styles/img/logo-vk.png"></a></li>
            <li class="sns"><a title="Telegram" href="index.html"><img alt="logo-tg" src="./styles/img/logo-telegram.png"></a></li>
            <li class="sns"><a title="YouTube" href="index.html"><img alt="logo-yt" src="./styles/img/logo-youtube.png"></a></li>
          </ul>
          ООО «Инитлаб», Краснодар, Россия. <br>
          Drupal является зарегистрированной торговой маркой Dries Buytaert.
        </div>
      </div>
    </div>
  </div>
</footer>