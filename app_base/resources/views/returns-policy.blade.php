@extends('layouts.frontend')
@section('title')
    <title>Craig Hughes Upholstery Returns Policy</title>
@append
@section('middle-content')
    <div class="w-full bg-heading bg-cover bg-center fade-in">
        <div class="w-full bg-black bg-opacity-60">
            <div class="container mx-auto pt-40 pb-20">
                <h1 class="text-white text-4xl font-thin mx-2 text-center">Returns Policy</h1>
                <div class="w-1/6 h-1 bg-white m-2 mb-4 mt-3 mx-auto"></div>
            </div>
        </div>
    </div>
    <section class="fade-in">
        <div class="container my-10 mx-auto max-w-screen-lg">
            <h1 class="text-2xl font-thin mx-2">Refunds will not be issued for the following reason</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div>
                    <p class="py-3">
                        You no longer want the item as it is the wrong colour or size. You should have checked your order before completion.
                    </p>
                </div>
            </div>
            <h1 class="text-2xl font-thin mx-2 pt-4">Online Sales: Customers who purchase online have the right to a refund if the item is faulty or damaged.</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div>
                    <p class="pt-3 pb-2">
                        1.) We will issue a refund if you tell us that the item is damaged or faulty within 14 days of receiving the goods. You then have another 14 days to return the goods to us once you have told us.
                    </p>
                    <p class="pt-3 pb-2">
                        2.) t is your responsibility to arrange and pay for the return of the goods and if the goods are not faulty or damaged you will receive a partial refund. If the item is faulty we will issue a refund for the amount you paid at the time of purchase but not the return postage
                    </p>
                </div>
            </div>
            <h1 class="text-2xl font-thin mx-2 pt-4">Replacements</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div>
                    <p class="pt-3 pb-2">
                        If you have ‘accepted’ an item but later discover a fault we will not replace the item if it does not fall within the 14 day period in clause 2
                    </p>
                </div>
            </div>
            <h1 class="text-2xl font-thin mx-2 pt-4">Items Returned by someone other than the buyer</h1>
            <div class="w-1/6 h-1 bg-gray-300 m-2 mb-4 mt-3"></div>
            <div class="grid grid-cols-1 gap-8 text-md mx-2">
                <div>
                    <p class="pt-3 pb-2">
                        We only accept returns from the person who bought the item.
                    </p>
                </div>
            </div>
        </div>
    </section>
@append
