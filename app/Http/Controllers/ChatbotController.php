<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function message(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $replies = [

            'hello' => 'Hi there How can I help you today?',
            'hi' => 'Hello How can I assist you?',
            'hey' => 'Hey there What can I do for you?',
            'good morning' => 'Good mornin Hope you have a great day ahead',
            'good afternoon' => 'Good afternoon How can I assist you?',
            'good evening' => 'Good evening What would you like to order?',


            'menu' => ' Our menu includes Starters, Main Dishes, and Desserts. What would you like to explore?',
            'starter' => 'Our starters include soups, fries, and salads.',
            'main dish' => 'We offer delicious biryanis, curries, and pizzas.',
            'dessert' => 'We have cakes, ice creams, and brownies',
            'special' => 'Today’s special: Paneer Butter Masala & Chicken Biryani',



            'order' => 'You can place your order from our Menu page. Would you like me to take you there?',
            'how to order' => 'Just go to the Menu page, choose your items, and click on "Add TO cart"',
            'add item' => 'Sure! Which item would you like to add to your order?',
            'confirm order' => 'Once you’re ready, click “Confirm Order” and we’ll start preparing your food',
             'good'=> 'Grate,what did you like to eat',

            'price' => ' Our prices start from ₹50.',




            'help' => 'Sure  I can assist you with menu, orders, prices,. What do you need help with?',
            'support' => 'Our support team is available 24/7. You can also message us via the contact page.',


            'feedback' => 'We’d love your feedback  Please share your experience on our Contact page.',
            'review' => 'You can leave a review on Google or on our website feedback form.',




            'who are you' => 'I’m your friendly food assistant , here to help you order delicious meals',
            'about' => 'We are a restaurant that serves freshly made dishes using top-quality ingredients ',
            'location' => ' We’re located in Chennai. You can visit us ',
            'open' => ' We’re open every day from 10 AM to 10 PM.',


            'bye' => 'Goodbye  Hope to see you again soon',
            'thank you' => 'You’re very welcome  Have a great day',
            'thanks' => 'No problem Always happy to help ',
        ];

        $message = strtolower($request->message);
        $reply = 'Sorry, I didn’t quite get that. Could you please rephrase? ';

        foreach ($replies as $key => $text) {
            if (str_contains($message, $key)) {
                $reply = $text;
                break;
            }
        }

        return response()->json(['message' => $reply]);
    }
}
