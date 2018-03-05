# Song-RNN

Song-RNN generates lyrics for deep learning using Torch-RNN trained on lyric datasets for pop, country, and hip-hop music. 

## Description
In this project, we created an end-to-end application that uses deep learning techniques and IBM's Watson services to generate original song lyrics. In our application, users can choose to generate lyrics from genres of pop, country, and hip-hop. In addition, users can choose a "root word" that is used as an initial input into the neural network from which the rest of the song lyrics are generated, and a creativity value that ranges from 0 being more repetitive and 1 being more creative. We find that our model generates lyrics with sentence structure and clean English, using vocabulary from the appropriate genre. Though it is not expected that a song written entirely by our model will be a Top-100 hit on iTunes, we hope that our originally-generated lyrics can serve as an aid for singers and songwriters who are looking for inspiration.

## Training
Neural network based on [Torch RNN](https://github.com/jcjohnson/torch-rnn) by Justin Johnson. We trained on relative small datasets for each genre (~3MB), as shown in the repository. Trained weights are not available due to the their large sizes. 

## Testing sample
Below is a test example for the hip hop genre with the root word "you" and a temperature of 0.5

You can see it for the city of the shit

I gotta see the game of your hands

The power on the floor is the only one moving and will think I would be
I want to be gonna get a real so last
And she know I have to pay and get like you can be
I should stop more down to me
I don't care the riches and we do it was that shot that I ain't to be
And I know my burned to the streets and my city
I'm a song to my brain with your heart to me
So I can do it words of the pain and be your hands
I wanna see the converses and who does
I spit the ground and go in the part
They stand going to my best and stars
And leave the court with my stars like we do
I seen the whole world that we have no doubt it
I wanna be really slow it all the streets
The other walker for the bitch and she live bars of my friends
