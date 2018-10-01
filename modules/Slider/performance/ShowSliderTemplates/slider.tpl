<div class="slider">
    <div class="swiper-wrapper">
        {foreach name="cat" from=$data item=item}
            <div class="swiper-slide">
                <img  fastedit:{$table_name}:{$item.id}
                     src="/modules/Slider/management/storage/images/data/image/{$item.id}/{$item.image}"
                     data-thumb="/modules/Slider/management/storage/images/data/image/{$item.id}/{$item.image}"
                     alt="slide-test"/>
            </div>
        {/foreach}
    </div>
    <div class="swiper-pagination"></div>
</div>


{literal}
    <script>
        var swiper = new Swiper('.slider', {
            pagination: {
                el: '.swiper-pagination',
            },
            clickable: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
        });
    </script>
{/literal}