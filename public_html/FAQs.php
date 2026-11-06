<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veel gestelde vragen</title>
    <?php include('../src/templates/bootstrap.html') ?>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php') ?>
    <div class="container">
        <h1>Veel gestelde vragen!</h1>
        <br>
        <div class="container">
            <h2>Bestellen</h2>
            <div class="accordion" id="accordionOrder">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Hoe bestel ik bij jullie?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionOrder">
                        <div class="accordion-body">


                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus mollis risus sit amet sagittis. Aliquam convallis, lectus quis congue efficitur, tortor justo feugiat enim, nec hendrerit metus nisl sed sem. Pellentesque nec elit at ipsum laoreet pulvinar sit amet a metus. Aliquam erat volutpat. Donec dapibus diam eu interdum rutrum. Donec tincidunt vulputate ipsum interdum mollis. Fusce quis tellus eget tellus pellentesque tincidunt. Donec pharetra velit at suscipit laoreet.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Hoe kan ik betalen?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionOrder">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac lectus ligula. Nulla laoreet varius dolor eget pharetra. Suspendisse vestibulum, risus non consectetur tincidunt, eros massa dignissim turpis, vitae sollicitudin diam lacus id urna. Morbi pellentesque justo ipsum. Fusce dapibus neque lacinia sodales auctor. Duis consectetur arcu a felis ultrices rhoncus. Aenean malesuada nunc vitae euismod ultrices. Maecenas eu convallis tortor, eu tempor enim. Vestibulum maximus eu ligula ac convallis. Fusce placerat diam dui, non finibus ligula suscipit et. Aenean dolor libero, sagittis eu velit sit amet, hendrerit molestie dolor. Vivamus placerat metus non tempus dictum. Fusce ultricies elit efficitur, dignissim erat nec, auctor massa. Cras varius neque augue, in feugiat nisl sollicitudin eget. Curabitur at ex tristique, vestibulum tellus sit amet, ornare est.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Hoe weet ik of mijn betaling/bestelling gelukt is?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionOrder">
                        <div class="accordion-body">


                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sagittis auctor mattis. Pellentesque eget erat quis tortor semper sollicitudin nec non elit. Vivamus molestie sit amet tellus vel rhoncus. Nunc in velit at arcu egestas semper eget ac magna. Sed vel ipsum augue. Nunc ut orci et dolor ullamcorper consequat. Ut dui dui, sagittis posuere odio in, bibendum imperdiet mauris. Sed lobortis nulla sit amet sapien hendrerit, eu facilisis lacus pulvinar. Vestibulum hendrerit, ipsum a consectetur vulputate, felis velit commodo nisl, id suscipit lorem enim at ligula. Proin in sapien a ante venenatis euismod. In hac habitasse platea dictumst. Donec aliquet, lacus et pharetra placerat, diam dolor molestie orci, a ullamcorper libero est nec ligula. Vivamus et ligula sit amet augue venenatis dictum. In eu quam et magna placerat dictum imperdiet quis erat. Etiam quis lacinia lacus.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                            Kan ik mijn bestelling nog annuleren/wijzigen?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionOrder">
                        <div class="accordion-body">


                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse aliquam finibus nunc, quis imperdiet lacus facilisis ut. Suspendisse eu felis eu erat blandit ultricies in quis nisi. Vestibulum nec auctor urna. Cras velit leo, luctus et libero et, molestie facilisis sem. Phasellus velit eros, vestibulum ac feugiat vel, interdum sit amet sapien. Nulla velit nunc, rhoncus id egestas ac, faucibus non velit. Sed a enim ac justo faucibus blandit. Nunc blandit lectus dapibus pulvinar blandit. </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <h2>Levering</h2>
            <div class="accordion" id="accordionDeliver">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                            Hoe snel wordt mijn bestelling geleverd? Wat is de levertermijn?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionDeliver">
                        <div class="accordion-body">


                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus mollis risus sit amet sagittis. Aliquam convallis, lectus quis congue efficitur, tortor justo feugiat enim, nec hendrerit metus nisl sed sem. Pellentesque nec elit at ipsum laoreet pulvinar sit amet a metus. Aliquam erat volutpat. Donec dapibus diam eu interdum rutrum. Donec tincidunt vulputate ipsum interdum mollis. Fusce quis tellus eget tellus pellentesque tincidunt. Donec pharetra velit at suscipit laoreet.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                            Er staat dat mijn bestelling is bezorgd, maar ik heb niks ontvangen. Wat nu?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionDeliver">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac lectus ligula. Nulla laoreet varius dolor eget pharetra. Suspendisse vestibulum, risus non consectetur tincidunt, eros massa dignissim turpis, vitae sollicitudin diam lacus id urna. Morbi pellentesque justo ipsum. Fusce dapibus neque lacinia sodales auctor. Duis consectetur arcu a felis ultrices rhoncus. Aenean malesuada nunc vitae euismod ultrices. Maecenas eu convallis tortor, eu tempor enim. Vestibulum maximus eu ligula ac convallis. Fusce placerat diam dui, non finibus ligula suscipit et. Aenean dolor libero, sagittis eu velit sit amet, hendrerit molestie dolor. Vivamus placerat metus non tempus dictum. Fusce ultricies elit efficitur, dignissim erat nec, auctor massa. Cras varius neque augue, in feugiat nisl sollicitudin eget. Curabitur at ex tristique, vestibulum tellus sit amet, ornare est.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                            Aan welke landen leveren jullie?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionDeliver">
                        <div class="accordion-body">


                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sagittis auctor mattis. Pellentesque eget erat quis tortor semper sollicitudin nec non elit. Vivamus molestie sit amet tellus vel rhoncus. Nunc in velit at arcu egestas semper eget ac magna. Sed vel ipsum augue. Nunc ut orci et dolor ullamcorper consequat. Ut dui dui, sagittis posuere odio in, bibendum imperdiet mauris. Sed lobortis nulla sit amet sapien hendrerit, eu facilisis lacus pulvinar. Vestibulum hendrerit, ipsum a consectetur vulputate, felis velit commodo nisl, id suscipit lorem enim at ligula. Proin in sapien a ante venenatis euismod. In hac habitasse platea dictumst. Donec aliquet, lacus et pharetra placerat, diam dolor molestie orci, a ullamcorper libero est nec ligula. Vivamus et ligula sit amet augue venenatis dictum. In eu quam et magna placerat dictum imperdiet quis erat. Etiam quis lacinia lacus.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include('../src/templates/footer.html') ?>
</body>

</html>
<?php
