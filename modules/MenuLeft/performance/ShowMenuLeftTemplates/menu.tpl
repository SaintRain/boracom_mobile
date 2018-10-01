<section fastedit:: class="mobilemenu">
    <div class="mobilebutton">X</div>
    <div class="menucontact">
        <p>+7(495) 640 21 99</p>
        <p>+7(495) 640 22 07</p>
        <p class="adress">Московская область, г. Красногорск,<br/>
            Павшинский бульвар, дом 17</p>
    </div>
    <ul>
        {assign var="needClose" value=0}
        {foreach name="cat" from=$menuItems item=list}

        {if !$list.deep && $needClose==1}
            {assign var="needClose" value=0}
            </ul>
        {/if}
            {if !$list.deep && !$list.otstup}
            <li ><a fastedit:{$table_name}:{$list.id} {if $list.selected}class="active"{/if}
                    href="{$list.name}{$list.url}" >{$list.item|ftext}</a></li>
            {/if}

            {if $list.otstup==1}
                {assign var="needClose" value=1}
                <li class="parent"><a  fastedit:{$table_name}:{$list.id} href="{$list.name}{$list.url}" >{$list.item|ftext}</a>
                <ul>
            {/if}

            {if $list.deep==1}
                <li><a  fastedit:{$table_name}:{$list.id} href="{$list.name}{$list.url}" {if $list.selected}class="active"{/if}>{$list.item|ftext}</a></li>
            {/if}

        {/foreach}
    </ul>
</section>