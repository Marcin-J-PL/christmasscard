{if isset($card) && $card.content|trim neq '' }
    <section id="module-christmasscard">
        <div class="content">
            {$card.content nofilter}
        </div>
    </section>
{/if}