<section class="time-line-box">
    <div class="swiper-container text-center">
        <div class="swiper-wrapper">
            <?php if(count($trace_requests)){
            foreach($trace_requests as $TraceRequest){
            $date = new \DateTime($TraceRequest->created_at);
            ?>
            <div class="swiper-slide">
                <div class="timestamp"><span class="date"><i
                                class="fa fa-clock-o"></i> {{$date->format('d/m/Y H:i')}}</span></div>
                <div class="status"><span> {{$TraceRequest->type}}</span></div>
            </div>
            <?php } }  ?>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<style>
    .timestamp .date {
        font-size: 13px;
        font-weight: bolder;
        padding-bottom: 15px !important;
    }

    .status span {
        color: #4e70fc;
        font-size: 15px;
        font-weight: bolder;
        padding-top: 25px !important;
    }

    .time-line-box {
        height: 100px;
        padding: 25px 0;
        width: 100%;
        height: 195px;
    }

    .time-line-box .timeline {
        list-style-type: none;
        display: flex;
        padding: 0;
        text-align: center;
    }

    .time-line-box .timestamp {
        margin: auto;
        margin-bottom: 5px;
        padding: 0px 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .time-line-box .status {
        padding: 0px 10px;
        display: flex;
        justify-content: center;
        border-top: 3px solid #455EFC;
        position: relative;
        transition: all 200ms ease-in;
    }

    .time-line-box .status span {
        padding-top: 8px;
    }

    .time-line-box .status span:before {
        content: '';
        width: 12px;
        height: 12px;
        background-color: #455EFC;
        border-radius: 12px;
        border: 2px solid #455EFC;
        position: absolute;
        left: 50%;
        top: 0%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        transition: all 200ms ease-in;
    }

    .swiper-container {
        width: 95%;
        margin: auto;
        overflow-y: auto;
    }

    .swiper-wrapper {
        display: inline-flex;
        flex-direction: row;
        overflow-y: auto;
        justify-content: center;
    }

    .swiper-slide {
        margin-bottom: 35px;
        text-align: center;
        font-size: 12px;
        width: 200px;
        height: 100%;
        position: relative;
    }
</style>
