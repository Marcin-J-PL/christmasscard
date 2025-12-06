{if isset($card) && $card.content|trim neq '' }
    <section id="module-christmasscard">
        <div class="content">
            {$card.content nofilter}
            <button type="button" class="close" aria-label="Zamknij">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </section>
{/if}