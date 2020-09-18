<script>document.getElementsByTagName("html")[0].className += " js";</script>
<link rel="stylesheet" href="/vendor/digisac/core-integration-laravel/css/timeline.css">


<section class="cd-h-timeline js-cd-h-timeline margin-bottom-md">
    <div class="cd-h-timeline__container container">
        <div class="cd-h-timeline__dates">
            <div class="cd-h-timeline__line">
                <ol>
                    <?php if(count($trace_requests)){
                        foreach($trace_requests as $TraceRequest){ ?>

                        <li><a href="#0" data-date="{{$TraceRequest->created_at}}" class="cd-h-timeline__date">{{$TraceRequest->type}}</a></li>

                 <?php } } ?>
                </ol>

                <span class="cd-h-timeline__filling-line" aria-hidden="true"></span>
            </div> <!-- .cd-h-timeline__line -->
        </div> <!-- .cd-h-timeline__dates -->

        <ul>
            <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--prev cd-h-timeline__navigation--inactive">Prev</a></li>
            <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--next">Next</a></li>
        </ul>
    </div> <!-- .cd-h-timeline__container -->

    <div class="cd-h-timeline__events">
        <ol>
            <?php if(count($trace_requests)){
                foreach($trace_requests as $TraceRequest){ ?>
            <li class="cd-h-timeline__event cd-h-timeline__event--selected text-component">
                <div class="cd-h-timeline__event-content container">
                    <h2 class="cd-h-timeline__event-title">{{$TraceRequest->type}}</h2>
                    <em class="cd-h-timeline__event-date">{{$TraceRequest->created_at}}</em>
                    <p class="cd-h-timeline__event-description color-contrast-medium">
                        <code>
                            {
                            "event": "bot.command",
                            "data": {
                            "id": "11fb65fb-9e24-4dd0-aa53-e8b4cecb47f4",
                            "contactId": "d85ae406-b6d2-473e-8983-4379f96463e1",
                            "accountId": "e57575aa-8995-43b6-8942-31e6e9135a25",
                            "command": "insere_nome_cancelamento",
                            "message": {
                            "id": "96b9dc15-d8a0-453c-bf14-cddf0c49445d",
                            }
                        </code>
                    </p>
                </div>
            </li>
                <?php } } ?>
        </ol>
    </div> <!-- .cd-h-timeline__events -->
</section>
<script src="/vendor/digisac/core-integration-laravel/js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
<script src="/vendor/digisac/core-integration-laravel/js/swipe-content.js"></script> <!-- A Vanilla JavaScript plugin to detect touch interactions -->
<script src="/vendor/digisac/core-integration-laravel/js/timeline.js"></script>