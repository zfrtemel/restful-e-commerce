import React from 'react'
import {  Outlet } from 'react-router-dom'
import { Header } from './pages/partials/Header'

export const Layout = () => {
    return (
        <>
            <Header />
            <Outlet />
            
            {/* <Footer/> */}
            
        </>
    )
}
