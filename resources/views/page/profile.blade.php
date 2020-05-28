@extends('master')
@section('content')
<div class="divided"></div>

<div class="page-profile">
    <div class="profile-avt container">
        <div class="content-wrapper">
            <div class="avatar-wrapper">
                <div class="f-avt-img">
                    @php
                        if($user->user_thumbnail != null){
                            echo '<img src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                        }
                        else
                            echo '<img src="upload/image/8vWG_pop.png" alt="">';
                    @endphp
                </div>
            </div>
            <div class="user-regisered">
                <span>@ {{$user->fname}} {{$user->lname}}</span><br>
                <span>Join in {{$user->created_at}}</span>
            </div>
        </div>
    </div>
    <div class="profile-activities container-fluid">
        <div class="tabbed-content container">
            <ul class="nav flex-column" id="tab-links">
                <li class="nav-item active">
                    <a onclick="switchTab(1)" class="nav-link"><i class="fas fa-circle-notch"></i> PUBLIC POST</a>
                </li>
                @if($accept)
                <li class="nav-item">
                    <a onclick="switchTab(2)" class="nav-link"><i class="fas fa-circle-notch"></i> UPDATE PROFILE</a>
                </li>
                @endif
                <li class="nav-item">
                    <a onclick="switchTab(3)" class="nav-link"><i class="fas fa-circle-notch"></i> COMMENT</a>
                </li>

            </ul>
            <div class="tab-pannels" >
                <section class="tab-activity" id="recipeData">
                    @if($data->count()>0)
                        <h2>ALL POST</h2>
                        <div class="row">
                            @foreach($data as $i)
                                <div class="col-md-4 item-grids">
                                    <div class="special-img">
                                        @if($i->img_thumb != null)
                                            @php
                                                $str = $i->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                            @endphp
                                        @else
                                            <img src="upload/icon/picture.png" alt="" id="photo-hero" />
                                        @endif
                                        <div class="title-content saves__title">
                                            <div class="title-author">
                                                @php
                                                    $img = \App\user::find($i->user_id);
                                                    if($img->user_thumbnail != null){
                                                        echo '<img src="upload/avatar/'.$img->user_thumbnail.'" alt="">';
                                                    }
                                                    else
                                                        echo '<img src="upload/image/8vWG_pop.png" alt="">';
                                                @endphp
                                            </div>
                                            <div class="details">
                                                <h2 class="title">
                                                    <a href="page/recipe/{{$i->slug}}">{{$i->title}}</a>
                                                </h2>
                                                <div class="recipe-data">
                                                    <div class="meta-data">
                                                        <span class="name">
                                                            @if($i->status==1)
                                                                Uploaded at <b>{{$i->created_at}}</b>
                                                            @else
                                                                Status: Pending Review
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if($accept === true)
                                                    <div class="author">
                                                        <span class="name">
                                                            <i class="fas fa-edit"></i><a href="page/edit/recipe/{{$i->slug}}" >Edit</a> |
                                                            <i class="fas fa-trash"></i><a onclick="return confirm('Are you sure to delete it ?');" href="page/myboard/del/recipe/{{$i->slug}}" style="color: red!important;">Delete</a> |
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="center">{{$data->links()}}</div>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" id="e8a6e089-f0a2-4336-8fc5-733c88302415" data-name="Layer 1" width="200" height="200" viewBox="0 0 888 485.489" class="injected-svg modal__media modal__lg_media" data-src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/breakfast_psiw.svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>breakfast</title><path d="M275.41211,460.30048H246.99329a3.76777,3.76777,0,0,0-3.76777,3.76776v12.47387a3.76777,3.76777,0,0,0,3.76777,3.76777h4.70941V499h19V480.30988h4.70941a3.76777,3.76777,0,0,0,3.76776-3.76777V464.06824A3.76777,3.76777,0,0,0,275.41211,460.30048Z" transform="translate(-156 -207.2555)" fill="#6c63ff"></path><path d="M303.87661,574.46128a146.10549,146.10549,0,0,1-25.418-86.62437,3.08142,3.08142,0,0,0-2.40522-3.075V479.372H246.03933v5.315h-.41356a3.07971,3.07971,0,0,0-3.06724,3.30786q3.54683,49.44186-23.95358,88.677a8.4873,8.4873,0,0,0-1.53606,5.14352l3.28188,101.51817a8.78815,8.78815,0,0,0,8.713,8.48191h67.88732a8.79123,8.79123,0,0,0,8.71824-8.63152l1.26471-98.56588A17.78875,17.78875,0,0,0,303.87661,574.46128Z" transform="translate(-156 -207.2555)" fill="#3f3d56"></path><path d="M269.48783,464.36493a8.12881,8.12881,0,0,1-16.25763,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M293.12991,608.18244h-8.22064a21.57614,21.57614,0,0,0-42.6488,0h-8.22118a6.06671,6.06671,0,0,0-5.99616,6.98918l8.92944,58.04135h51.27407l10.84608-57.84582A6.0667,6.0667,0,0,0,293.12991,608.18244Z" transform="translate(-156 -207.2555)" fill="#6c63ff"></path><polygon points="827.952 307.634 825.98 386.448 823.538 484.181 740.414 484.181 737.552 369.675 736 307.634 827.952 307.634" fill="#e6e6e6"></polygon><rect x="775.72312" y="265.70393" width="11.76981" height="155.95002" fill="#6c63ff"></rect><path d="M978.06676,574.27527l-2.22611,112.02H900.07391l-2.60826-131.24365a51.63393,51.63393,0,0,1,40.82688,5.61536C950.95161,568.15405,965.173,572.18424,978.06676,574.27527Z" transform="translate(-156 -207.2555)" fill="#3f3d56"></path><rect x="752.03074" y="379.63032" width="10.79992" height="10.79992" fill="#e6e6e6"></rect><rect x="759.38688" y="357.56192" width="10.79992" height="10.79992" fill="#e6e6e6"></rect><rect x="936.42384" y="575.81564" width="10.79992" height="10.79992" transform="translate(375.57517 -653.92108) rotate(36.56259)" fill="#e6e6e6"></rect><rect x="955.93676" y="594.95132" width="10.79992" height="10.79992" transform="translate(390.81432 -661.77916) rotate(36.56259)" fill="#e6e6e6"></rect><rect x="922.83416" y="605.98552" width="10.79992" height="10.79992" transform="translate(390.87303 -639.88846) rotate(36.56259)" fill="#e6e6e6"></rect><circle cx="805.14765" cy="351.03508" r="2.20684" fill="#3f3d56"></circle><circle cx="760.27524" cy="336.32281" r="2.20684" fill="#3f3d56"></circle><circle cx="797.79152" cy="320.87493" r="2.20684" fill="#3f3d56"></circle><circle cx="444.50808" cy="241.75402" r="241.75402" fill="#6c63ff"></circle><path d="M600.50808,625.46663a176.45595,176.45595,0,1,1,124.77436-51.68275A175.30352,175.30352,0,0,1,600.50808,625.46663Zm0-342.0314c-91.29808,0-165.5743,74.27621-165.5743,165.57429,0,91.2977,74.27622,165.5743,165.5743,165.5743,91.2977,0,165.57429-74.2766,165.57429-165.5743C766.08237,357.71144,691.80578,283.43523,600.50808,283.43523Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><circle cx="444.50808" cy="241.75402" r="171.0157" fill="#3f3d56"></circle><path d="M473.32742,380.62742a21.704,21.704,0,1,1,38.68118-19.69819l48.31632,94.87836a21.704,21.704,0,1,1-38.68118,19.69819Z" transform="translate(-156 -207.2555)" fill="#ff6584"></path><path d="M478.71655,391.21l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C501.72232,374.77607,488.38616,380.817,478.71655,391.21Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M489.12314,411.64534l-2.23-4.379c11.12915-8.64736,24.19788-15.007,38.68117-19.69819l2.23,4.379C512.12891,395.21141,498.79275,401.25236,489.12314,411.64534Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M499.52973,432.08068l-2.23-4.379c11.12915-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C522.5355,415.64675,509.19935,421.6877,499.52973,432.08068Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M509.93632,452.516l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C532.94209,436.08209,519.60594,442.123,509.93632,452.516Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M520.34292,472.95136l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C543.34868,456.51743,530.01253,462.55838,520.34292,472.95136Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M437.07906,416.14643a21.704,21.704,0,1,1,38.68118-19.6982l48.31632,94.87837a21.704,21.704,0,0,1-38.68118,19.69819Z" transform="translate(-156 -207.2555)" fill="#ff6584"></path><path d="M442.46819,426.729l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C465.474,410.29508,452.1378,416.336,442.46819,426.729Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M452.87478,447.16435l-2.23-4.379c11.12915-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C475.88055,430.73042,462.5444,436.77137,452.87478,447.16435Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M463.28137,467.59969l-2.23-4.379c11.12915-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C486.28714,451.16576,472.951,457.20671,463.28137,467.59969Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M473.688,488.035l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C496.69373,471.6011,483.35758,477.64205,473.688,488.035Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M484.09456,508.47037l-2.23-4.379c11.12916-8.64736,24.19788-15.007,38.68118-19.69819l2.23,4.379C507.10032,492.03644,493.76417,498.07739,484.09456,508.47037Z" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M714.77766,454.45093l.15257.00013a25.8881,25.8881,0,0,0,24.23924-16.23619,84.50284,84.50284,0,0,0,5.9231-31.69393c-.27144-45.91073-37.62223-83.57515-83.52936-84.21021a84.74394,84.74394,0,0,0-35.27687,162.32018,25.66668,25.66668,0,0,0,28.50566-5.28585A84.45815,84.45815,0,0,1,714.77766,454.45093Z" transform="translate(-156 -207.2555)" fill="#e6e6e6"></path><circle cx="515.24639" cy="193.55868" r="27.98439" fill="#f9a825"></circle><circle cx="454.42624" cy="187.11516" r="3.29669" fill="#3f3d56"></circle><circle cx="345.59806" cy="190.22453" r="3.29669" fill="#3f3d56"></circle><circle cx="471.99609" cy="152.94948" r="3.29669" fill="#3f3d56"></circle><circle cx="471.90243" cy="247.97277" r="3.29669" fill="#3f3d56"></circle><circle cx="537.19934" cy="146.14069" r="3.29669" fill="#3f3d56"></circle><circle cx="324.20705" cy="236.31261" r="3.29669" fill="#3f3d56"></circle><circle cx="348.30472" cy="283.7306" r="3.29669" fill="#3f3d56"></circle><circle cx="499.69951" cy="289.94935" r="12.43751" fill="#ff6584"></circle><path d="M665.02764,497.9822a9.32813,9.32813,0,0,1-18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M646.37138,496.42751a9.32813,9.32813,0,0,1,18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="495.03545" cy="285.67396" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="499.69951" cy="284.11927" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="499.69951" cy="294.22475" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="504.36357" cy="288.00599" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="503.58623" cy="296.55678" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="494.2581" cy="292.67006" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><circle cx="524.57452" cy="256.52356" r="12.43751" fill="#ff6584"></circle><path d="M689.90265,464.5564a9.32813,9.32813,0,0,1-18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M671.24639,463.00172a9.32813,9.32813,0,0,1,18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="519.91046" cy="252.24816" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="524.57452" cy="250.69348" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="524.57452" cy="260.79895" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="529.23859" cy="254.5802" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="528.46124" cy="263.13098" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="519.13311" cy="259.24426" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><circle cx="549.44953" cy="273.62513" r="12.43751" fill="#6c63ff"></circle><path d="M714.77766,481.658a9.32813,9.32813,0,0,1-18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M696.1214,480.10329a9.32813,9.32813,0,0,1,18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="544.78547" cy="269.34974" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="549.44953" cy="267.79505" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="549.44953" cy="277.90052" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="554.1136" cy="271.68177" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="553.33625" cy="280.23255" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="544.00812" cy="276.34583" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><circle cx="487.262" cy="275.17982" r="12.43751" fill="#6c63ff"></circle><path d="M652.59013,483.21266a9.32813,9.32813,0,0,1-18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M633.93387,481.658a9.32813,9.32813,0,0,1,18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="482.59794" cy="270.90442" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="487.262" cy="269.34974" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="487.262" cy="279.45521" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="491.92607" cy="273.23646" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="491.14872" cy="281.78724" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="481.8206" cy="277.90052" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><circle cx="515.24639" cy="280.62122" r="12.43751" fill="#6c63ff"></circle><path d="M680.57452,488.65407a9.32813,9.32813,0,1,1-18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M661.91826,487.09938a9.32813,9.32813,0,1,1,18.65626,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="510.58233" cy="276.34583" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="515.24639" cy="274.79114" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="515.24639" cy="284.89662" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="519.91046" cy="278.67786" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="519.13311" cy="287.22865" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><ellipse cx="509.80498" cy="283.34193" rx="0.77734" ry="1.16602" fill="#6c63ff"></ellipse><circle cx="534.68" cy="293.83607" r="12.43751" fill="#ff6584"></circle><path d="M700.00812,501.86892a9.32812,9.32812,0,1,1-18.65625,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><path d="M681.35187,500.31423a9.32812,9.32812,0,1,1,18.65625,0" transform="translate(-156 -207.2555)" opacity="0.2"></path><ellipse cx="530.01593" cy="289.56068" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="534.68" cy="288.00599" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="534.68" cy="298.11147" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="539.34406" cy="291.89271" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="538.56672" cy="300.4435" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><ellipse cx="529.23859" cy="296.55678" rx="0.77734" ry="1.16602" fill="#ff6584"></ellipse><circle cx="374.73442" cy="246.41808" r="3.29669" fill="#3f3d56"></circle><polygon points="464.345 366.08 385.17 344.123 388.203 332.857 467.378 354.815 464.345 366.08" fill="#f9a825"></polygon><path d="M608.73806,569.57043a218.26828,218.26828,0,0,1-82.07767,0V557.89212a250.99129,250.99129,0,0,0,82.07767,0Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M617.17595,534.53552a218.26828,218.26828,0,0,1-82.07767,0V522.85721a250.99184,250.99184,0,0,0,82.07767,0Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M645.558,548.54948a218.26833,218.26833,0,0,1-82.07768,0v-11.6783a250.9919,250.9919,0,0,0,82.07768,0Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M652.46168,561.78489a218.26787,218.26787,0,0,1-82.07767,0v-11.6783a250.99184,250.99184,0,0,0,82.07767,0Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><polygon points="520.531 371.824 439.554 385.426 437.676 373.904 518.652 360.302 520.531 371.824" fill="#f9a825"></polygon><path d="M664.43494,580.57677a219.97,219.97,0,0,1-74.58008,34.78439l-4.80446-10.61152a252.95437,252.95437,0,0,0,74.58007-34.78439Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M657.68866,545.16625a219.96991,219.96991,0,0,1-74.58007,34.78439l-4.80446-10.61152a252.95437,252.95437,0,0,0,74.58007-34.78439Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M689.24339,545.87182a219.96977,219.96977,0,0,1-74.58008,34.78439l-4.80446-10.61151a252.95471,252.95471,0,0,0,74.58008-34.7844Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><path d="M700.96153,554.97242a219.96991,219.96991,0,0,1-74.58007,34.78439L621.577,579.14529a252.95437,252.95437,0,0,0,74.58007-34.78439Z" transform="translate(-156 -207.2555)" fill="#f9a825"></path><rect x="442.95339" y="324.92984" width="3.88672" height="3.88672" fill="#00bf71"></rect><rect x="454.61355" y="392.55878" width="3.88672" height="3.88672" fill="#00bf71"></rect><rect x="392.42602" y="324.92984" width="3.88672" height="3.88672" fill="#00bf71"></rect><rect x="482.59794" y="373.12517" width="3.88672" height="3.88672" fill="#00bf71"></rect><rect x="484.92997" y="350.5822" width="3.88672" height="3.88672" fill="#00bf71"></rect><rect x="574.85572" y="545.40019" width="5.44141" height="3.10938" transform="translate(250.70796 -437.19066) rotate(34.15572)" fill="#00bf71"></rect><rect x="620.71902" y="553.95098" width="5.44141" height="3.10938" transform="translate(263.41949 -461.46545) rotate(34.15572)" fill="#00bf71"></rect><rect x="564.75025" y="568.72051" width="5.44141" height="3.10938" transform="translate(262.05797 -427.49459) rotate(34.15572)" fill="#00bf71"></rect><rect x="596.62136" y="565.61114" width="5.44141" height="3.10938" transform="translate(1249.17714 182.37779) rotate(124.15572)" fill="#00bf71"></rect><rect x="617.60965" y="571.05255" width="5.44141" height="3.10938" transform="translate(1286.45203 173.50612) rotate(124.15572)" fill="#00bf71"></rect><rect x="673.57842" y="552.39629" width="5.44141" height="3.10938" transform="matrix(-0.56144, 0.82751, -0.82751, -0.56144, 1358.40581, 98.06043)" fill="#00bf71"></rect><rect y="483.24828" width="888" height="2.24072" fill="#3f3d56"></rect></svg>
                        <div class="message">
                            <h3>HMMM...</h3>
                            <p>Looks like {{$user->fname}} {{$user->lname}} has no activity!</p>
                        </div>
                    @endif
                </section>
                <section class="tab-activity" id="updateProfile" >
                    @if($accept===true)<h2>Update your profile</h2>
                    <div class="wrap">
                        <div class="user-profile">
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Error!</strong>
                                    @foreach($errors->all() as $err)
                                        <p>{{$err}}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    <strong>{{session('thongbao')}}</strong>
                                </div>
                            @endif
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div>
                                    <h4>Name</h4>
                                    <fieldset>
                                        <label for="user_name">Username</label>
                                        <input type="text" name="user_name" id="username" placeholder="{{$user->login}}" value="{{$user->login}}" readonly>
                                    </fieldset>
                                    <fieldset>
                                        <label for="user_fname">First Name</label>
                                        <input type="text" name="user_fname" id="userfname" value="{{$user->fname}}" required>

                                    </fieldset>
                                    <fieldset>
                                        <label for="user_lname">Last Name</label>
                                        <input type="text" name="user_lname" id="userlname" value="{{$user->lname}}" required>
                                    </fieldset>
                                    <fieldset>
                                        <label for="user_role">Role</label>
                                        <select name="user_role" id="userrole">
                                            @if(Auth::user()->role==2)
                                                <option value="1" disabled>Administrator</option>
                                                <option value="2">Editor</option>
                                                <option value="3">Subscriber</option>
                                            @else
                                                <option value="1">Administrator</option>
                                                <option value="2">Editor</option>
                                                <option value="3">Subscriber</option>
                                            @endif

                                        </select>
                                    </fieldset>
                                </div>
                                <div>
                                    <h4>Contact Info</h4>
                                    <fieldset>
                                        <label for="user_email">Email(Required)</label>
                                        <input type="text" name="user_email" id="useremail" value="{{$user->email}}" required>
                                    </fieldset>
                                    <fieldset>
                                        <label for="user_fb_url">Facebook profile URL</label>
                                        <input type="text" name="user_fb_url" id="userfburl">

                                    </fieldset>
                                </div>
                                <div>
                                    <h4>About Yourself</h4>
                                    <fieldset>
                                        <label for="user_bio">Biographical Info</label>
                                        <input type="text" name="user_bio" id="userbio" placeholder="{{$user->bio}}">
                                        <label for="user_img">Profile Picture</label>
                                        @if($user->user_thumbnail=="")
                                            <img src="source/content/img/avt/user.svg" alt="" name="user-img">
                                        @else
                                            <img src="./upload/avatar/{{$user->user_thumbnail}}" alt="" name="user-img">
                                        @endif
                                    </fieldset>
                                    <fieldset>
                                        <label for="user_thumbnail">Updating your avatar</label>
                                        <input type="file" name="user_thumbnail">
                                    </fieldset>
                                </div>
                                <div>
                                    <h4>Account Management</h4>
                                    <fieldset>
                                        <label for="user_pwd">Password</label>
                                        <input type="password" name="user_pwd" id="userpwd" value="{{$user->password}}" required>
                                    </fieldset>
                                    <fieldset>
                                        <label for="retypepwd">Retype password</label>
                                        <input type="password" name="retypepwd" id="retypepwd" placeholder="">
                                    </fieldset>

                                </div>
                                <div class="post__submit">
                                    <button type="submit">Publish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </section>
                <section class="tab-activity" id="comment" >
                    <h2>Comment</h2>
                    <div class="conservation__posts">
                        <ol class="conservation__posts-list">
                            @if($cmt->count()==0)
                                <li class="conservation__post">
                                    <div class="post">
                                        <div class="post__text">
                                            <div class="post__text-truncate">
                                                <h2>Be the first to comment on this recipe</h2>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                @foreach($cmt as $i)
                                    <li class="conservation__post">
                                        <div class="post">
                                            <div class="post__avt">
                                                <a href="#" class="user-avt round-avt">
                                                    @php
                                                        $user = $i->user;
                                                        if($user->user_thumbnail != null){
                                                            echo '<img class="user-avt__img" src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                                                        }
                                                        else
                                                            echo '<img class="user-avt__img" src="upload/image/8vWG_pop.png" alt="">';
                                                    @endphp
                                                </a>
                                            </div>
                                            <div class="post__header">
                                                <div class="post__meta">
                                                    <div class="post__author">
                                                        @if($i->topic==1)
                                                            Photo by
                                                        @elseif($i->topic==2)
                                                            Review by
                                                        @else
                                                            Ask by
                                                        @endif
                                                        <a href="page/profile/{{$i->user->login}}" class="post__author-link"> {{\App\user::where('id','=',$i->user_id)->get()->first()->fname}} {{\App\user::where('id','=',$i->user_id)->get()->first()->lname}}</a>
                                                    </div>
                                                    <div class="post__date">
                                                        <span>{{$i->created_at}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post__text">
                                                <div class="post__text-truncate">
                                                    <span>" {{$i->content}} "</span>
                                                </div>
                                            </div>
                                            <div class="post__img">
                                                <div class="post__img-truncate">
                                                    <img src="upload/image/{{$i->img_url}}" alt="">
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ol>
                        <div class="conservation__show-more">
                            {{$cmt->links()}}
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let s2 = document.getElementById('updateProfile');
    let s3 = document.getElementById('comment');
    s2.style.display="none";
    s3.style.display="none";
</script>
<script type="text/javascript">
    $("#tab-links li").click(function() {
        $(".nav li.active").removeClass("active");
        $(this).addClass("active");
    });
</script>

@endsection
