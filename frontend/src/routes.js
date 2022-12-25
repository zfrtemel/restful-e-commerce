import { Route, Routes } from "react-router-dom";
import React from 'react'
import { Product } from "./pages/Product";
import { Home } from "./pages/Home";

export const RoutesList = () => {
    return (
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/books" element={<Product />} />
        </Routes>
    )
}
