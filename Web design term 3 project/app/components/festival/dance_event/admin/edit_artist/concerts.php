<h2 class="text-2xl text-center mb-6">Concerts</h2>
<ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($concerts as $concert): ?>
        <li class="block bg-white hover:bg-gray-100 border border-gray-200 rounded-lg p-4 transition duration-150">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-800">
                    <?php $date = htmlspecialchars($concert->dateAndTime);
                    $formattedDate = new DateTime($date);
                    echo $formattedDate->format('d M Y') ?>
                </p>
                <p class="text-sm text-gray-600">Club: <?php echo htmlspecialchars($concert->location); ?></p>
            </div>

        </li>
    <?php endforeach; ?>
</ul>

<h2 class="text-green-700 my-5 text-2xl text-center mb-6">Here you can manage the concerts to which
    the singer
    participates.</h2>
<a href="/danceManageTickets"
    class="my-5 block w-full max-w-xs mx-auto bg-yellow-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">
    Manage Tickets
</a>