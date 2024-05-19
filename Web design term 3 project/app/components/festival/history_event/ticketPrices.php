<!-- ------------------------------- -->

<div class="event-info-container">
    <h1 class="event-info-header">Ticket Prices</h1>
</div>

<div class="ticket-price-container">

    <div class="ticket-price-info">
        <img class="ticket-price-image" src="<?php echo htmlspecialchars($firstHistoryTicket->imagePath); ?>"
            alt="History Event">
        <div class="ticket-price-info-text">
            <h1 class="ticket-price-header">
                <?php echo htmlspecialchars($firstHistoryTicket->ticketType); ?>
            </h1>
            <p class="ticket-price-text">
                <?php echo htmlspecialchars(number_format($firstHistoryTicket->price, 2, '.', '')) . ' €'; ?>
            </p>
            <p class="ticket-price-text">
                <?php echo htmlspecialchars($firstHistoryTicket->description); ?>
            </p>
            <a href="/tickethistory?type=regular">
                <button type="button" class="btn2">Buy Now</button>
            </a>
        </div>
    </div>

    <div class="ticket-price-info-2">
        <div class="ticket-price-info-text-2">
            <h1 class="ticket-price-header-2">
                <?php echo htmlspecialchars($secondHistoryTicket->ticketType); ?>
            </h1>
            <p class="ticket-price-text-2">
                <?php echo htmlspecialchars(number_format($secondHistoryTicket->price, 2, '.', '')) . ' €'; ?>
            </p>
            <p class="ticket-price-text-2">
                <?php echo htmlspecialchars($secondHistoryTicket->description); ?>
            </p>
            <a href="/tickethistory?type=family">
                <button type="button" class="btn2">Buy Now</button>
            </a>
        </div>
        <img class="ticket-price-image-2" src="<?php echo htmlspecialchars($secondHistoryTicket->imagePath); ?>"
            alt="History Event">
    </div>
</div>