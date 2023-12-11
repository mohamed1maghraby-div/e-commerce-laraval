import NavBarLogin from '../../Components/Utility/NavBarLogin';
import Slider from '../../Components/Home/Slider';
import HomeCategory from '../../Components/Home/HomeCategory';

const HomePage = () => {
    return (
        <div className="font">
            <NavBarLogin />
            <Slider />
            <HomeCategory />
        </div>
    )
}

export default HomePage