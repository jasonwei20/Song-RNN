# Song-RNN

Song-RNN generates lyrics for deep learning using Torch-RNN trained on lyric datasets for pop, country, and hip-hop music. 

## Description
In this project, we created an end-to-end application that uses deep learning techniques and IBM's Watson services to generate original song lyrics. In our application, users can choose to generate lyrics from genres of pop, country, and hip-hop. In addition, users can choose a "root word" that is used as an initial input into the neural network from which the rest of the song lyrics are generated, and a creativity value that ranges from 0 being more repetitive and 1 being more creative. We find that our model generates lyrics with sentence structure and clean English, using vocabulary from the appropriate genre. Though it is not expected that a song written entirely by our model will be a Top-100 hit on iTunes, we hope that our originally-generated lyrics can serve as an aid for singers and songwriters who are looking for inspiration.

Neural network based on [Torch RNN](https://github.com/jcjohnson/torch-rnn) by Justin Johnson. 

Trained weights are not available due to the their large sizes. 
