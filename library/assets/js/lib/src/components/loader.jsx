import React, { Component } from "react"

class Loader extends Component {

    constructor(props) {
        super(props);
        this.state = {
        randomWittyText: '',
        wittyTexts: [ 'Generating witty dialog...', 'Spinning violently around the y-axis...', 'Have a good day.', 'Upgrading Windows, your PC will restart several times. Sit back and relax.', 'We\'re building the stuff as fast as we can', '(Pay no attention to the man behind the curtain)', '...and enjoy the elevator music...', 'Would you like fries with that?', 'Go ahead -- hold your breath!', '...at least you\'re not on hold...', 'We\'re testing your patience', 'As if you had any other choice', 'Why don\'t you order a sandwich?', 'While the satellite moves into position', 'keep calm and npm install', 'The bits are flowing slowly today', 'Have you lost weight?', 'Just count to 10', 'Why so serious?', 'It\'s not you. It\'s me.', 'Counting backwards from Infinity', 'Don\'t panic...', 'Do not run! We are your friends!', 'Do you come here often?', 'Spinning the wheel of fortune...', 'Computing chance of success', 'I feel like im supposed to be loading something. . .', 'Should have used a compiled language...', 'Is this Windows?', 'Don\'t break your screen yet!', 'I swear it\'s almost done.', 'Let\'s take a mindfulness minute...', 'Time flies when you’re having fun.', 'Be careful not to step in the git-gui', 'Your left thumb points to the right and your right thumb points to the left.', 'Wait, do you smell something burning?', 'I love my job only when I\'m on vacation...', 'Sometimes I think war is God’s way of teaching us geography.', 'I’ve got problem for your solution…..', 'I think I am, therefore, I am. I think.', 'You don’t pay taxes—they take taxes.', 'I am free of all prejudices. I hate everyone equally.', 'git happens', 'This is not a joke, it\'s a commit.', 'We are not liable for any broken screens as a result of waiting.', 'If you type Google into Google you can break the internet', 'Dividing by zero...', 'If I’m not back in five minutes, just wait longer.', 'Some days, you just can’t get rid of a bug!', 'I need to git pull --my-life-together', 'Looking for sense of humour, please hold on.', 'Please wait while the intern refills his coffee.', 'Installing dependencies', 'Switching to the latest JS framework...', 'Finding someone to hold my beer', 'BRB, working on my side project', '@todo Insert witty loading message', 'Let\'s hope it\'s worth the wait', 'Whatever you do, don\'t look behind you...', 'Feel free to spin in your chair', 'Go ahead, hold your breath and do an ironman plank till loading complete', 'Help, I\'m trapped in a loader!', 'Updating to Windows Vista...', 'Everything in this universe is either a potato or not a potato', 'Reading Terms and Conditions for you.', 'Sooooo... Have you seen my vacation photos yet?', 'Still faster than Windows update' ]
        };
    }

    shuffleArray = () => {
        let random = Math.floor((Math.random() * (this.state.wittyTexts.length-1)) + 1);
        this.setState({ randomWittyText: this.state.wittyTexts[random] });
    }

    componentDidMount() {
        this.setState({ randomWittyText: this.state.wittyTexts[Math.floor((Math.random() * (this.state.wittyTexts.length-1)) + 1)] }),
        this.timerInterval = setInterval(this.shuffleArray.bind(this), 2000);
    }

    componentWillUnmount() {
        clearInterval(this.timerInterval);
    }

    render() {
        return (
        <div className="loader-box">
            <div className="mighty-loader">
            <svg className="circular" viewBox="25 25 50 50">
                <circle className="path" cx={50} cy={50} r={20} fill="none" strokeWidth={2} strokeMiterlimit={10} />
            </svg>
            </div>
            <p className="wittiness">{ this.state.randomWittyText }</p>
        </div>
        )
    }
}

export default Loader;