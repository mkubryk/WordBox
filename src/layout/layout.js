import { Link, Outlet } from "react-router-dom";
import Header from "../components/header";
import Footer from "../components/footer";

export default function Layout() {
    return (
        <div id="sidebar">
            <Header/>
            <div>
                <Outlet />
            </div>
            <Footer/>
        </div>


    );
}